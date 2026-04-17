<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function show()
    {
        $page = LandingPage::firstOrCreate(['id' => 1]);
        return view('welcome', compact('page'));
    }

    public function edit()
    {
        $page = LandingPage::firstOrCreate(['id' => 1]);
        return view('admin.landing.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_badge'        => 'required|string|max:255',
            'hero_title'        => 'required|string|max:255',
            'hero_subtitle'     => 'required|string',
            'stat1_number'      => 'required|string|max:50',
            'stat1_label'       => 'required|string|max:100',
            'stat2_number'      => 'required|string|max:50',
            'stat2_label'       => 'required|string|max:100',
            'stat3_number'      => 'required|string|max:50',
            'stat3_label'       => 'required|string|max:100',
            'card_title'        => 'required|string|max:255',
            'card_subtitle'     => 'required|string|max:255',
            'feature1_icon'     => 'required|string|max:10',
            'feature1_title'    => 'required|string|max:255',
            'feature1_desc'     => 'required|string',
            'feature2_icon'     => 'required|string|max:10',
            'feature2_title'    => 'required|string|max:255',
            'feature2_desc'     => 'required|string',
            'feature3_icon'     => 'required|string|max:10',
            'feature3_title'    => 'required|string|max:255',
            'feature3_desc'     => 'required|string',
            'cta_title'         => 'required|string|max:255',
            'cta_desc'          => 'required|string',
            'step1_title'       => 'required|string|max:255',
            'step1_desc'        => 'required|string',
            'step2_title'       => 'required|string|max:255',
            'step2_desc'        => 'required|string',
            'step3_title'       => 'required|string|max:255',
            'step3_desc'        => 'required|string',
            'testimonial1_text' => 'required|string',
            'testimonial1_name' => 'required|string|max:255',
            'testimonial1_role' => 'required|string|max:255',
            'testimonial2_text' => 'required|string',
            'testimonial2_name' => 'required|string|max:255',
            'testimonial2_role' => 'required|string|max:255',
            'testimonial3_text' => 'required|string',
            'testimonial3_name' => 'required|string|max:255',
            'testimonial3_role' => 'required|string|max:255',
            'footer_text'       => 'nullable|string|max:255',
            'footer_site_name'  => 'required|string|max:255',
            'footer_tagline'    => 'required|string|max:255',
            'footer_copyright'  => 'required|string|max:255',
            'footer_facebook'   => 'nullable|string|max:255',
            'footer_twitter'    => 'nullable|string|max:255',
            'footer_linkedin'   => 'nullable|string|max:255',
            'footer_instagram'  => 'nullable|string|max:255',
        ]);

        LandingPage::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Landing page updated successfully.');
    }
}
