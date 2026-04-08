<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CookieSettings;
use App\Models\Announcement;
use App\Models\Scholarship;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $studentId = $student?->id;

        // Single query for all application counts
        $counts = $studentId
            ? Application::where('student_id', $studentId)
                ->selectRaw('
                    COUNT(*) as total,
                    SUM(status = "approved") as approved,
                    SUM(status = "pending") as pending,
                    SUM(status = "rejected") as rejected
                ')
                ->first()
            : (object)['total' => 0, 'approved' => 0, 'pending' => 0, 'rejected' => 0];

        $userApplications = $studentId
            ? Application::with('scholarship')
                ->where('student_id', $studentId)
                ->latest()
                ->take(10)
                ->get()
            : collect();

        $availableScholarships = Scholarship::where('approval_status', 'approved')
            ->where('status', 'active')
            ->count();

        $featuredScholarships = Scholarship::where('status', 'active')->take(6)->get();

        $cookieSettings = CookieSettings::getSettings();
        $hasConsent = request()->cookie('announcement_consent') === 'true';
        $showAnnouncements = $cookieSettings->enabled
            && $cookieSettings->show_on_student_dashboard
            && $hasConsent;

        $announcements = $showAnnouncements
            ? Announcement::active()->where('show_on_student_dashboard', true)->get()
            : collect();

        return view('student.dashboard', [
            'totalApplications'    => (int) $counts->total,
            'approvedApplications' => (int) $counts->approved,
            'pendingApplications'  => (int) $counts->pending,
            'rejectedApplications' => (int) $counts->rejected,
            'availableScholarships' => $availableScholarships,
            'userApplications'     => $userApplications,
            'featuredScholarships' => $featuredScholarships,
            'cookieSettings'       => $cookieSettings,
            'announcements'        => $announcements,
        ]);
    }
}
