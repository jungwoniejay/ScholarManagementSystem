<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function screened()
    {
        return view('admin.applications.screened');
    }

    public function review()
    {
        return view('admin.applications.review');
    }

    public function shortlist()
    {
        return view('admin.applications.shortlist');
    }
}
