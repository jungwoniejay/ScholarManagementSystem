<?php

namespace App\Console\Commands;

use App\Models\AiRule;
use Illuminate\Console\Command;

class SeedAiRules extends Command
{
    protected $signature = 'ai:seed-rules';
    protected $description = 'Seed default AI screening rules';

    public function handle(): void
    {
        $rules = [
            ['key' => 'weight_gpa',                'value' => '40'],
            ['key' => 'weight_financial_need',     'value' => '30'],
            ['key' => 'weight_personal_statement', 'value' => '20'],
            ['key' => 'weight_enrollment_year',    'value' => '10'],
            ['key' => 'min_gpa',                   'value' => '2.00'],
            ['key' => 'auto_reject_below_gpa',     'value' => '1.50'],
            ['key' => 'gpa_excellent_threshold',   'value' => '3.50'],
            ['key' => 'gpa_good_threshold',        'value' => '2.75'],
            ['key' => 'auto_shortlist_score',      'value' => '80'],
            ['key' => 'auto_reject_score',         'value' => '30'],
            ['key' => 'auto_review_score',         'value' => '50'],
            ['key' => 'preferred_enrollment_year', 'value' => '1,2'],
            ['key' => 'max_enrollment_year',       'value' => '4'],
            ['key' => 'allowed_courses',           'value' => 'all'],
            ['key' => 'min_statement_words',       'value' => '50'],
            ['key' => 'require_documents',         'value' => 'true'],
            ['key' => 'min_documents',             'value' => '1'],
            ['key' => 'score_label_high',          'value' => '75'],
            ['key' => 'score_label_medium',        'value' => '50'],
        ];

        foreach ($rules as $rule) {
            AiRule::updateOrCreate(['key' => $rule['key']], ['value' => $rule['value']]);
        }

        $this->info('✓ ' . count($rules) . ' AI rules seeded successfully.');
    }
}
