<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Task Master',
                'description' => 'Complete 10 tasks to earn this badge',
                'icon' => 'CheckCircle',
                'criteria_type' => 'tasks_completed',
                'criteria_value' => 10,
                'is_system_default' => true,
            ],
            [
                'name' => 'Project Creator',
                'description' => 'Create 5 projects to earn this badge',
                'icon' => 'FolderPlus',
                'criteria_type' => 'projects_created',
                'criteria_value' => 5,
                'is_system_default' => true,
            ],
            [
                'name' => 'Bug Hunter',
                'description' => 'Report 5 bugs to earn this badge',
                'icon' => 'Bug',
                'criteria_type' => 'bugs_reported',
                'criteria_value' => 5,
                'is_system_default' => true,
            ],
            [
                'name' => 'Idea Generator',
                'description' => 'Submit 10 ideas to earn this badge',
                'icon' => 'Lightbulb',
                'criteria_type' => 'ideas_submitted',
                'criteria_value' => 10,
                'is_system_default' => true,
            ],
            [
                'name' => 'Team Player',
                'description' => 'Join 3 teams to earn this badge',
                'icon' => 'Users',
                'criteria_type' => 'teams_joined',
                'criteria_value' => 3,
                'is_system_default' => true,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
