<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('landing_page')->where('id', 1)->update([
            'feature1_detail' => "Our AI-powered matching engine analyzes your academic profile, GPA, course of study, financial background, and extracurricular achievements to instantly surface the scholarships you are most likely to qualify for.\n\n✦ Personalized recommendations updated in real time\n✦ Filters by amount, deadline, field of study, and eligibility\n✦ AI scoring shows your match percentage for each scholarship\n✦ Reduces hours of manual searching to just a few clicks\n\nNo more sifting through hundreds of irrelevant listings — ScholarHub puts the right opportunities in front of you from day one.",

            'feature2_detail' => "Stay on top of every application with a centralized dashboard that gives you a clear, real-time view of where each submission stands — from the moment you apply to the day an award is confirmed.\n\n✦ Live status updates: Pending → Under Review → Shortlisted → Awarded\n✦ Donor response tracking so you know when a decision has been made\n✦ Document verification status per application\n✦ Full application history with timestamps\n✦ Wallet balance reflecting credited scholarship funds\n\nTransparency at every step means you are never left wondering what happens next.",

            'feature3_detail' => "Missing a scholarship deadline is one of the most avoidable setbacks in a student's journey. ScholarHub makes sure it never happens to you.\n\n✦ Automatic deadline reminders as closing dates approach\n✦ Application status notifications sent directly to your account\n✦ Announcements banner on the platform for urgent updates\n✦ Donor approval and award notifications in real time\n✦ Email alerts for every major milestone in your application\n\nWith ScholarHub watching your deadlines, you can focus entirely on crafting the strongest application possible.",
        ]);
    }

    public function down(): void
    {
        DB::table('landing_page')->where('id', 1)->update([
            'feature1_detail' => null,
            'feature2_detail' => null,
            'feature3_detail' => null,
        ]);
    }
};
