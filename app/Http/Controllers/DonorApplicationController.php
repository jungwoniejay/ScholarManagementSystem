<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Donator;
use App\Models\Student;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonorApplicationController extends Controller
{
    /**
     * Display a listing of applications for the donor to review.
     */
    public function index(Request $request)
    {
        // Get the donor associated with the authenticated user
        $donator = Donator::where('user_id', auth()->id())->first();

        if (!$donator) {
            return redirect()->route('donator.dashboard')
                ->with('error', 'Donor profile not found. Please contact administrator.');
        }

        $status = $request->input('status', 'pending');

        // Get applications assigned to this donor based on filter
        $query = Application::with(['student', 'scholarship', 'documents'])
            ->where('donator_id', $donator->donator_id);

        switch ($status) {
            case 'pending':
                $query->where('donor_status', 'pending')
                      ->where('status', 'shortlisted');
                break;
            case 'approved':
                $query->where('donor_status', 'approved');
                break;
            case 'rejected':
                $query->where('donor_status', 'rejected');
                break;
            case 'all':
                // Show all
                break;
        }

        $applications = $query->orderByDesc('ai_score')->paginate(15);

        // Get statistics
        $stats = [
            'pending' => Application::where('donator_id', $donator->donator_id)
                ->where('donor_status', 'pending')
                ->where('status', 'shortlisted')
                ->count(),
            'approved' => Application::where('donator_id', $donator->donator_id)
                ->where('donor_status', 'approved')
                ->count(),
            'rejected' => Application::where('donator_id', $donator->donator_id)
                ->where('donor_status', 'rejected')
                ->count(),
            'total' => Application::where('donator_id', $donator->donator_id)->count(),
        ];

        return view('donator.applications.index', compact('applications', 'stats', 'status'));
    }

    /**
     * Display the specified application for donor review.
     */
    public function show(Application $application)
    {
        // Ensure the application belongs to this donor
        $donator = Donator::where('user_id', auth()->id())->first();

        if (!$donator || $application->donator_id !== $donator->donator_id) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->load(['student', 'scholarship', 'documents']);

        return view('donator.applications.show', compact('application'));
    }

    /**
     * Store the donor's decision on an application.
     */
    public function updateDecision(Request $request, Application $application)
    {
        $request->validate([
            'decision' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string|max:1000',
            'awarded_amount' => 'nullable|numeric|min:0',
        ]);

        // Ensure the application belongs to this donor
        $donator = Donator::where('user_id', auth()->id())->first();

        if (!$donator || $application->donator_id !== $donator->donator_id) {
            abort(403, 'Unauthorized access to this application.');
        }

        DB::beginTransaction();

        try {
            // Derive awarded amount from scholarship if not manually specified
            $awardedAmount = $request->decision === 'approved'
                ? ($request->awarded_amount ?? $application->scholarship->amount ?? 0)
                : 0;

            $application->donor_status      = $request->decision;
            $application->donor_remarks     = $request->remarks;
            $application->donor_reviewed_at = now();
            $application->awarded_amount    = $awardedAmount;

            if ($request->decision === 'approved') {
                $application->status   = 'approved';
                $application->notified = false;

                // Deduct from donor's available fund
                if ($donator->available_fund >= $awardedAmount) {
                    $donator->decrement('available_fund', $awardedAmount);
                }
            } else {
                $application->status = 'rejected';
            }

            $application->save();

            DB::commit();

            SystemLog::create([
                'log_type'    => 'Donor Decision',
                'related_id'  => $application->id,
                'user_id'     => auth()->id(),
                'description' => 'Donor ' . auth()->user()->name . ' ' . $request->decision . ' application #' . $application->id . ($request->remarks ? '. Remarks: ' . $request->remarks : '') . '.',
            ]);

            return redirect()->route('donator.applications.index')
                ->with('success', 'Decision recorded successfully. The student will be notified.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to record decision. Please try again.');
        }
    }

    /**
     * Display applications awaiting student response.
     */
    public function awaitingResponse()
    {
        $donator = Donator::where('user_id', auth()->id())->first();

        if (!$donator) {
            return redirect()->route('donator.dashboard')
                ->with('error', 'Donor profile not found.');
        }

        $applications = Application::with(['student', 'scholarship'])
            ->where('donator_id', $donator->donator_id)
            ->where('donor_status', 'approved')
            ->whereNull('student_response')
            ->orderByDesc('donor_reviewed_at')
            ->paginate(15);

        return view('donator.applications.awaiting-response', compact('applications'));
    }

    /**
     * Display awarded scholarships (completed applications).
     */
    public function awarded()
    {
        $donator = Donator::where('user_id', auth()->id())->first();

        if (!$donator) {
            return redirect()->route('donator.dashboard')
                ->with('error', 'Donor profile not found.');
        }

        $applications = Application::with(['student', 'scholarship'])
            ->where('donator_id', $donator->donator_id)
            ->where('donor_status', 'approved')
            ->whereNotNull('student_response')
            ->orderByDesc('student_responded_at')
            ->paginate(15);

        return view('donator.applications.awarded', compact('applications'));
    }
}