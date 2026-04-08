<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::whereHas('student', function($query) {
            $query->where('user_id', auth()->id());
        })->with('scholarship')->paginate(10);

        return view('student.applications.index', compact('applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scholarship_id'     => 'required|exists:scholarships,id',
            'personal_statement' => 'required|string|max:3000',
            'documents'          => 'nullable|array|max:10',
            'documents.*'        => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student profile not found.');
        }

        $scholarship = Scholarship::findOrFail($request->scholarship_id);

        if (!$scholarship->isAcceptingApplications()) {
            return redirect()->back()->with('error', 'This scholarship is no longer accepting applications.');
        }

        $existing = Application::where('student_id', $student->id)
            ->where('scholarship_id', $scholarship->id)
            ->whereNotIn('status', ['rejected', 'declined'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already applied for this scholarship.');
        }

        DB::beginTransaction();
        try {
            $application = Application::create([
                'student_id'         => $student->id,
                'scholarship_id'     => $scholarship->id,
                'status'             => 'pending',
                'donor_status'       => 'pending',
                'personal_statement' => $request->personal_statement,
                'applied_at'         => now(),
            ]);

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $path = $file->store('documents/applications/' . $application->id, 'public');
                    Document::create([
                        'application_id' => $application->id,
                        'name'           => $file->getClientOriginalName(),
                        'file_path'      => $path,
                        'status'         => 'pending',
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('student.scholarships.status')
                ->with('success', 'Application submitted successfully! We will review it shortly.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to submit application. Please try again.');
        }
    }
}
