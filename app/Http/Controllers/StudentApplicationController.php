<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class StudentApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::whereHas('student', function($query) {
            $query->where('user_id', auth()->id());
        })->with('scholarship')->paginate(10);

        return view('student.applications.index', compact('applications'));
    }
}
