<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use Illuminate\Support\Collection;

class NotificationController extends Controller
{
    public function all()
    {
        // Get recent time period for notifications
        $recentTime = now()->subDays(30); // Show notifications from last 30 days

        // Build notifications collection similar to dashboard
        $notifications = collect();

        // New Students
        $newStudents = Student::with('user')
            ->where('created_at', '>=', $recentTime)
            ->get(['id', 'user_id', 'created_at']);

        foreach($newStudents as $student) {
            $notifications->push([
                'id' => 'student_' . $student->id,
                'type' => 'new_student',
                'title' => 'New Student Registration',
                'message' => ($student->user->name ?? 'Student') . ' has registered',
                'time' => $student->created_at,
                'icon' => 'user',
                'color' => 'emerald',
                'color_class' => 'emerald',
                'link' => route('admin.students.show', $student->id)
            ]);
        }

        // New Applications
        $newApplications = Application::with(['student.user', 'scholarship'])
            ->where('created_at', '>=', $recentTime)
            ->get(['id', 'student_id', 'scholarship_id', 'created_at']);

        foreach($newApplications as $application) {
            $notifications->push([
                'id' => 'application_' . $application->id,
                'type' => 'new_application',
                'title' => 'New Application',
                'message' => ($application->student->user->name ?? 'Student') . ' applied for ' . ($application->scholarship->name ?? 'scholarship'),
                'time' => $application->created_at,
                'icon' => 'document',
                'color' => 'blue',
                'color_class' => 'blue',
                'link' => route('admin.applications.show', $application->id)
            ]);
        }

        // Pending Reviews
        $pendingReviews = Application::with('student.user')
            ->where('status', 'pending')
            ->get(['id', 'student_id', 'created_at', 'status']);

        foreach($pendingReviews as $review) {
            $notifications->push([
                'id' => 'review_' . $review->id,
                'type' => 'pending_review',
                'title' => 'Pending Review',
                'message' => 'Application from ' . ($review->student->user->name ?? 'Student') . ' needs review',
                'time' => $review->created_at,
                'icon' => 'clock',
                'color' => 'amber',
                'color_class' => 'amber',
                'link' => route('admin.applications.review')
            ]);
        }

        // Pending Documents
        $pendingDocuments = Application::whereHas('documents', function($q) {
            $q->where('status', 'pending');
        })
        ->with('student.user')
        ->get(['id', 'student_id', 'updated_at']);

        foreach($pendingDocuments as $doc) {
            $notifications->push([
                'id' => 'document_' . $doc->id,
                'type' => 'pending_document',
                'title' => 'Document Verification',
                'message' => 'Documents from ' . ($doc->student->user->name ?? 'Student') . ' need verification',
                'time' => $doc->updated_at,
                'icon' => 'check',
                'color' => 'purple',
                'color_class' => 'purple',
                'link' => route('admin.documents.verify')
            ]);
        }

        // Approved Applications
        $approvedApplications = Application::with('student.user')
            ->where('status', 'approved')
            ->where('updated_at', '>=', $recentTime)
            ->get(['id', 'student_id', 'updated_at']);

        foreach($approvedApplications as $approved) {
            $notifications->push([
                'id' => 'approved_' . $approved->id,
                'type' => 'approved',
                'title' => 'Application Approved',
                'message' => ($approved->student->user->name ?? 'Student') . '\'s application was approved',
                'time' => $approved->updated_at,
                'icon' => 'success',
                'color' => 'green',
                'color_class' => 'green',
                'link' => route('admin.applications.show', $approved->id)
            ]);
        }

        // Sort by time (most recent first) and paginate
        $notifications = $notifications->sortByDesc('time');
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $total = $notifications->count();
        $paginatedNotifications = $notifications->forPage($currentPage, $perPage);

        return view('admin.notifications.all', compact('paginatedNotifications', 'total', 'currentPage', 'perPage'));
    }
}
