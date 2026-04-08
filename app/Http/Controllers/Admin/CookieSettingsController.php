<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CookieSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieSettingsController extends Controller
{
    public function index()
    {
        $settings = \App\Models\CookieSettings::firstOrCreate(['id' => 1]);
        return view('admin.cookies.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'enabled' => 'boolean',
            'banner_title' => 'required|string|max:255',
            'banner_message' => 'required|string',
            'accept_label' => 'required|string|max:100',
            'decline_label' => 'required|string|max:100',
            'analytics_enabled' => 'boolean',
            'marketing_enabled' => 'boolean',
            'expiry_days' => 'integer|min:1|max:3650',
            'show_on_landing' => 'boolean',
            'show_on_student_dashboard' => 'boolean',
            'privacy_url' => 'nullable|string|max:255',
            'terms_url' => 'nullable|string|max:255',
            'privacy_content' => 'nullable|string',
            'terms_content' => 'nullable|string',
        ]);

        \App\Models\CookieSettings::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Cookie settings updated successfully.');
    }
}
?>

