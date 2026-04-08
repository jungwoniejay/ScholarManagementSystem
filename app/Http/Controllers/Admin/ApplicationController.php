<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Donator;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function pending()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);
        return view('admin.applications.pending', compact('applications'));
    }

    public function screened()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->where('status', 'review')
            ->latest()
            ->paginate(15);
        return view('admin.applications.screened', compact('applications'));
    }

    public function review()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->whereIn('status', ['pending', 'review'])
            ->latest()
            ->paginate(15);
        return view('admin.applications.review', compact('applications'));
    }

    public function shortlist()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->where('status', 'shortlisted')
            ->latest()
            ->paginate(15);
        return view('admin.applications.shortlist', compact('applications'));
    }

    public function completed()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->where('status', 'completed')
            ->latest()
            ->paginate(15);
        return view('admin.applications.completed', compact('applications'));
    }

    public function rejected()
    {
        $applications = Application::with(['student.user', 'scholarship'])
            ->where('status', 'rejected')
            ->latest()
            ->paginate(15);
        return view('admin.applications.rejected', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load(['student.user', 'scholarship', 'documents', 'donator']);

        // Only donors who fund this specific scholarship
        $donators = $application->scholarship
            ? $application->scholarship->donators()->select('donators.donator_id', 'donators.organization_name')->get()
            : collect();

        // Fallback: if no linked donors, show all donors
        if ($donators->isEmpty()) {
            $donators = Donator::select('donator_id', 'organization_name')->get();
        }

        return view('admin.applications.show', compact('application', 'donators'));
    }

    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'status'      => 'required|in:pending,review,shortlisted,approved,rejected',
            'donator_id'  => 'nullable|exists:donators,donator_id',
            'admin_remarks' => 'nullable|string|max:1000',
        ]);

        $application->status = $data['status'];
        $application->remarks = $data['admin_remarks'] ?? $application->remarks;

        if ($data['status'] === 'shortlisted' && !empty($data['donator_id'])) {
            $application->donator_id = $data['donator_id'];
            $application->donor_status = 'pending';
        }

        $application->save();

        return redirect()->route('admin.applications.show', $application->id)
            ->with('success', 'Application status updated successfully.');
    }
}
