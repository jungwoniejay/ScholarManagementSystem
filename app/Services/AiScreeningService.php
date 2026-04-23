<?php

namespace App\Services;

use App\Models\AiRule;
use App\Models\Application;

class AiScreeningService
{
    private array $rules = [];

    public function __construct()
    {
        $this->rules = AiRule::pluck('value', 'key')->toArray();
    }

    private function rule(string $key, mixed $default = null): mixed
    {
        return $this->rules[$key] ?? $default;
    }

    /**
     * Score and optionally auto-screen an application.
     * Returns the computed score (0–100).
     */
    public function screen(Application $application): float
    {
        $application->loadMissing(['student', 'scholarship', 'documents']);
        $student     = $application->student;
        $scholarship = $application->scholarship;

        if (!$student) return 0;

        // ── 1. Hard reject: GPA below absolute minimum ────────────────
        $autoRejectGpa = (float) $this->rule('auto_reject_below_gpa', 1.50);
        if ($student->gpa !== null && (float) $student->gpa < $autoRejectGpa) {
            $this->applyStatus($application, 'rejected', 0);
            return 0;
        }

        // ── 2. Hard reject: below min_gpa ─────────────────────────────
        $minGpa = (float) $this->rule('min_gpa', 2.00);
        if ($student->gpa !== null && (float) $student->gpa < $minGpa) {
            $this->applyStatus($application, 'rejected', 0);
            return 0;
        }

        // ── 3. Course filter ──────────────────────────────────────────
        $allowedCourses = $this->rule('allowed_courses', 'all');
        if ($allowedCourses !== 'all' && $student->course) {
            $allowed = array_map('trim', explode(',', strtolower($allowedCourses)));
            if (!in_array(strtolower($student->course), $allowed)) {
                $this->applyStatus($application, 'rejected', 0);
                return 0;
            }
        }

        // ── 4. Enrollment year filter ─────────────────────────────────
        $maxYear = (int) $this->rule('max_enrollment_year', 4);
        if ($student->enrollment_year && (int) $student->enrollment_year > $maxYear) {
            $this->applyStatus($application, 'rejected', 0);
            return 0;
        }

        // ── 5. Document requirement ───────────────────────────────────
        $requireDocs = $this->rule('require_documents', 'true') === 'true';
        $minDocs     = (int) $this->rule('min_documents', 1);
        if ($requireDocs && $application->documents->count() < $minDocs) {
            $this->applyStatus($application, 'rejected', 0);
            return 0;
        }

        // ── 6. Compute score ──────────────────────────────────────────
        $score = 0;

        // GPA score (weight_gpa %)
        $wGpa = (float) $this->rule('weight_gpa', 40);
        if ($student->gpa !== null) {
            $gpaExcellent = (float) $this->rule('gpa_excellent_threshold', 3.50);
            $gpaGood      = (float) $this->rule('gpa_good_threshold', 2.75);
            $gpa          = (float) $student->gpa;

            if ($gpa >= $gpaExcellent)      $gpaPoints = 100;
            elseif ($gpa >= $gpaGood)       $gpaPoints = 75;
            elseif ($gpa >= $minGpa)        $gpaPoints = 50;
            else                            $gpaPoints = 0;

            $score += ($wGpa / 100) * $gpaPoints;
        }

        // Personal statement score (weight_personal_statement %)
        $wStatement  = (float) $this->rule('weight_personal_statement', 20);
        $minWords    = (int) $this->rule('min_statement_words', 50);
        $wordCount   = $application->personal_statement
            ? str_word_count($application->personal_statement)
            : 0;
        $stmtPoints  = $wordCount >= $minWords ? 100 : ($wordCount > 0 ? 50 : 0);
        $score      += ($wStatement / 100) * $stmtPoints;

        // Enrollment year score (weight_enrollment_year %)
        $wYear    = (float) $this->rule('weight_enrollment_year', 10);
        $preferred = array_map('trim', explode(',', $this->rule('preferred_enrollment_year', '1,2')));
        $yearPoints = in_array((string) $student->enrollment_year, $preferred) ? 100 : 50;
        $score     += ($wYear / 100) * $yearPoints;

        // Financial need placeholder (weight_financial_need %)
        // Currently gives full points — extend when income data is available
        $wFinancial = (float) $this->rule('weight_financial_need', 30);
        $score     += ($wFinancial / 100) * 100;

        $score = round(min(100, max(0, $score)), 2);

        // ── 7. Auto-action based on score ─────────────────────────────
        $autoShortlist = (float) $this->rule('auto_shortlist_score', 80);
        $autoReject    = (float) $this->rule('auto_reject_score', 30);
        $autoReview    = (float) $this->rule('auto_review_score', 50);

        if ($score >= $autoShortlist) {
            $status = 'shortlisted';
        } elseif ($score >= $autoReview) {
            $status = 'review';
        } elseif ($score <= $autoReject) {
            $status = 'rejected';
        } else {
            $status = 'pending';
        }

        $this->applyStatus($application, $status, $score);

        return $score;
    }

    private function applyStatus(Application $application, string $status, float $score): void
    {
        $application->ai_score = $score;
        $application->status   = $status;
        $application->save();
    }
}
