<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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
            $exists = DB::table('ai_rules')->where('key', $rule['key'])->exists();
            if (!$exists) {
                DB::table('ai_rules')->insert(array_merge($rule, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }

    public function down(): void
    {
        $keys = [
            'weight_gpa','weight_financial_need','weight_personal_statement',
            'weight_enrollment_year','min_gpa','auto_reject_below_gpa',
            'gpa_excellent_threshold','gpa_good_threshold','auto_shortlist_score',
            'auto_reject_score','auto_review_score','preferred_enrollment_year',
            'max_enrollment_year','allowed_courses','min_statement_words',
            'require_documents','min_documents','score_label_high','score_label_medium',
        ];
        DB::table('ai_rules')->whereIn('key', $keys)->delete();
    }
};
