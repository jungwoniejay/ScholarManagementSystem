<?php

namespace Database\Seeders;

use App\Models\AiRule;
use Illuminate\Database\Seeder;

class AiRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // ── Scoring weights (must add up to 100) ──────────────────
            ['key' => 'weight_gpa',               'value' => '40'],
            ['key' => 'weight_financial_need',    'value' => '30'],
            ['key' => 'weight_personal_statement','value' => '20'],
            ['key' => 'weight_enrollment_year',   'value' => '10'],

            // ── GPA thresholds ─────────────────────────────────────────
            ['key' => 'min_gpa',                  'value' => '2.00'],
            ['key' => 'auto_reject_below_gpa',    'value' => '1.50'],
            ['key' => 'gpa_excellent_threshold',  'value' => '3.50'],
            ['key' => 'gpa_good_threshold',       'value' => '2.75'],

            // ── Auto-screening actions ─────────────────────────────────
            ['key' => 'auto_shortlist_score',     'value' => '80'],
            ['key' => 'auto_reject_score',        'value' => '30'],
            ['key' => 'auto_review_score',        'value' => '50'],

            // ── Enrollment year preference ─────────────────────────────
            ['key' => 'preferred_enrollment_year','value' => '1,2'],
            ['key' => 'max_enrollment_year',      'value' => '4'],

            // ── Course filter ──────────────────────────────────────────
            ['key' => 'allowed_courses',          'value' => 'all'],

            // ── Personal statement ─────────────────────────────────────
            ['key' => 'min_statement_words',      'value' => '50'],

            // ── Document requirements ──────────────────────────────────
            ['key' => 'require_documents',        'value' => 'true'],
            ['key' => 'min_documents',            'value' => '1'],

            // ── Score label thresholds ─────────────────────────────────
            ['key' => 'score_label_high',         'value' => '75'],
            ['key' => 'score_label_medium',       'value' => '50'],
        ];

        foreach ($rules as $rule) {
            AiRule::updateOrCreate(['key' => $rule['key']], ['value' => $rule['value']]);
        }
    }
}
