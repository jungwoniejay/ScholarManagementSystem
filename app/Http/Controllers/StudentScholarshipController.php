<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentScholarshipController extends Controller
{
    /**
     * Display a listing of available scholarships for students
     */
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->first();

        $search = $request->input('search');
        $sort   = $request->input('sort');

        $query = Scholarship::where('approval_status', 'approved')
            ->where('status', 'active')
            ->where(function($subQuery) {
                $subQuery->whereNull('application_deadline')
                      ->orWhere('application_deadline', '>=', now());
            });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('eligibility_criteria', 'like', "%{$search}%");
            });
        }

        if ($student) {
            $resolvedApplicationIds = Application::where('student_id', $student->id)
                ->whereIn('status', ['completed', 'rejected', 'declined'])
                ->pluck('scholarship_id');
            $query->whereNotIn('id', $resolvedApplicationIds);
        }

        match($sort) {
            'amount-high' => $query->orderByDesc('amount'),
            'amount-low'  => $query->orderBy('amount'),
            'deadline'    => $query->orderBy('application_deadline'),
            default       => $query->orderByDesc('created_at'),
        };

        $scholarships = $query->paginate(12)->withQueryString();

        return view('student.scholarships.index', compact('scholarships', 'search', 'sort'));
    }

    /**
     * Display scholarships awarded to the student (donor approved, awaiting response)
     */
    public function awarded()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Student profile not found.');
        }

        // Get applications where donor approved and awaiting student response
        $awardedApplications = Application::with(['scholarship', 'donator'])
            ->where('student_id', $student->id)
            ->where('donor_status', 'approved')
            ->whereNull('student_response')
            ->orderByDesc('donor_reviewed_at')
            ->paginate(10);

        // Get responded applications
        $respondedApplications = Application::with(['scholarship', 'donator'])
            ->where('student_id', $student->id)
            ->where('donor_status', 'approved')
            ->whereNotNull('student_response')
            ->orderByDesc('student_responded_at')
            ->paginate(10);

        return view('student.scholarships.awarded', compact('awardedApplications', 'respondedApplications'));
    }

    /**
     * Accept or decline a scholarship award
     */
    public function respond(Request $request, Application $application)
    {
        $request->validate([
            'response' => 'required|in:accept,decline',
        ]);

        $student = Student::where('user_id', auth()->id())->first();

        if (!$student || $application->student_id !== $student->id) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Only allow response if donor approved and no response yet
        if ($application->donor_status !== 'approved' || $application->student_response !== null) {
            return redirect()->back()
                ->with('error', 'This application cannot be responded to at this time.');
        }

        // Ensure scholarship is loaded for awarded_amount fallback
        $application->loadMissing('scholarship');

        DB::beginTransaction();

        try {
            $application->student_response    = $request->response;
            $application->student_responded_at = now();
            $application->status              = $request->response === 'accept' ? 'completed' : 'declined';
            $application->save();

            // Auto-credit wallet on acceptance
            if ($request->response === 'accept') {
                $creditAmount = (float) ($application->awarded_amount > 0
                    ? $application->awarded_amount
                    : $application->scholarship->amount ?? 0);

                if ($creditAmount > 0) {
                    $wallet = $student->getOrCreateWallet();
                    $wallet->credit(
                        $creditAmount,
                        'Scholarship award: ' . ($application->scholarship->name ?? 'Scholarship'),
                        $application->id
                    );
                }
            }

            // If declined, restore donor's available fund
            if ($request->response === 'decline' && $application->donator) {
                $application->donator->increment('available_fund', $application->awarded_amount);
            }

            DB::commit();

            $message = $request->response === 'accept'
                ? 'Congratulations! You have accepted the scholarship. The funds will be disbursed according to the scholarship terms.'
                : 'You have declined the scholarship. Thank you for your response.';

            return redirect()->route('student.scholarships.awarded')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to process your response. Please try again.');
        }
    }

    /**
     * Display scholarship details for student
     */
    public function show(Scholarship $scholarship)
    {
        // Check if scholarship is approved
        if ($scholarship->approval_status !== 'approved') {
            abort(403, 'This scholarship is not available for application.');
        }

        // Check if scholarship is active
        if ($scholarship->status !== 'active') {
            abort(403, 'This scholarship is currently inactive.');
        }

        $student = Student::where('user_id', auth()->id())->first();
        
        // Check if student already has an application for this scholarship
        $existingApplication = null;
        if ($student) {
            $existingApplication = Application::where('student_id', $student->id)
                ->where('scholarship_id', $scholarship->id)
                ->first();
            
            // If student has a resolved application (completed, rejected, declined) for this scholarship,
            // they cannot apply again but can still view the scholarship details
            if ($existingApplication && in_array($existingApplication->status, ['completed', 'rejected', 'declined'])) {
                // Don't abort - just show the scholarship with "already applied" message
                $scholarship->load(['applications', 'donators']);
                return view('student.scholarships.show', compact('scholarship', 'existingApplication'));
            }
        }
        
        // For students without resolved applications, check if they can apply
        if (!$existingApplication) {
            // Check if application deadline has passed
            if ($scholarship->application_deadline && $scholarship->application_deadline->isPast()) {
                abort(403, 'The application deadline for this scholarship has passed.');
            }

            // Check if scholarship is fully funded
            if ($scholarship->isFullyFunded()) {
                abort(403, 'This scholarship has reached its maximum funding and is no longer accepting applications.');
            }
        }

        $scholarship->load(['applications', 'donators']);

        return view('student.scholarships.show', compact('scholarship', 'existingApplication'));
    }

    /**
     * Display all applications and their status for the student
     */
    public function status()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Student profile not found.');
        }

        $applications = Application::with(['scholarship', 'donator'])
            ->where('student_id', $student->id)
            ->orderByDesc('applied_at')
            ->paginate(15);

        // Group by status for easy display
        $groupedApplications = [
            'pending' => $applications->filter(fn($app) => in_array($app->status, ['pending', 'review'])),
            'shortlisted' => $applications->filter(fn($app) => $app->status === 'shortlisted' && $app->donor_status === 'pending'),
            'awaiting_response' => $applications->filter(fn($app) => $app->donor_status === 'approved' && $app->student_response === null),
            'accepted' => $applications->filter(fn($app) => $app->student_response === 'accept'),
            'declined' => $applications->filter(fn($app) => $app->student_response === 'decline' || $app->donor_status === 'rejected'),
        ];

        return view('student.scholarships.status', compact('applications', 'groupedApplications'));
    }
}
