<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemLog; // Make sure you have this model

class ReportController extends Controller
{
    /**
     * Display a listing of system logs.
     */
    public function index()
    {
        // Fetch logs with pagination, latest first
        $logs = SystemLog::latest()->paginate(15);

        // Return the admin view and pass the logs
        return view('admin.reports.index', compact('logs'));
    }
}
