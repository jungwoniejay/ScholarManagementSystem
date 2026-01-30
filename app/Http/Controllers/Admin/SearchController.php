<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Scholarship;
use App\Models\Application;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('admin.dashboard');
        }

        // Search across multiple models
        $students = Student::with('user')
            ->whereHas('user', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->orWhere('student_id', 'like', "%{$query}%")
            ->get();

        $scholarships = Scholarship::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        $applications = Application::with(['student.user', 'scholarship'])
            ->whereHas('student.user', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('scholarship', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->get();

        return view('admin.search.results', compact('students', 'scholarships', 'applications', 'query'));
    }
}
