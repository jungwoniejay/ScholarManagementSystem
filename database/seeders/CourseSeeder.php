<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Bachelor of Science in Information Technology',
                'code' => 'BSIT',
                'description' => 'A program that focuses on the use of computing technology to solve business and organizational problems.',
                'is_active' => true,
            ],
            [
                'name' => 'Bachelor of Elementary Education',
                'code' => 'BEED',
                'description' => 'A program that prepares students to teach at the elementary school level.',
                'is_active' => true,
            ],
            [
                'name' => 'Bachelor of Science in Accountancy',
                'code' => 'BSAB',
                'description' => 'A program that prepares students for a career in accounting and finance.',
                'is_active' => true,
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['code' => $course['code']],
                $course
            );
        }
    }
}