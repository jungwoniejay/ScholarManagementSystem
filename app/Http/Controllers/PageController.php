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

    /**
     * Show the terms and conditions page.
     */
    public function termsAndConditions()
    {
        $settings = CookieSettings::firstOrCreate(['id' => 1]);
        $pageTitle = 'Terms and Conditions';
        
        return view('pages.terms-and-conditions', compact('settings', 'pageTitle'));
    }
}