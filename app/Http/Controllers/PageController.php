<?php

namespace App\Http\Controllers;

use App\Models\CookieSettings;

class PageController extends Controller
{
    /**
     * Show the privacy policy page.
     */
    public function privacyPolicy()
    {
        $settings = CookieSettings::firstOrCreate(['id' => 1]);
        $pageTitle = 'Privacy Policy';
        return view('pages.privacy-policy', compact('settings', 'pageTitle'));
    }

    public function termsAndConditions()
    {
        $settings = CookieSettings::firstOrCreate(['id' => 1]);
        $pageTitle = 'Terms and Conditions';
        return view('pages.terms-and-conditions', compact('settings', 'pageTitle'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string|max:200',
            'message'    => 'required|string',
        ]);

        // Log to system or send mail here if needed
        return redirect()->route('contact')->with('contact_success', true);
    }
}