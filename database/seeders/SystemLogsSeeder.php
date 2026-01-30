<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SystemLogsSeeder extends Seeder
{
    public function run(): void
    {
        $logTypes = [
            'Application Logs',
            'Approval History',
            'Fund Disbursement Logs',
            'AI Decision Logs',
            'System Activity Logs'
        ];

        for ($i = 1; $i <= 20; $i++) {
            DB::table('system_logs')->insert([
                'log_type' => $logTypes[array_rand($logTypes)],
                'related_id' => rand(1, 10),
                'user_id' => rand(1, 5),
                'description' => 'Sample log entry #' . $i . ' - ' . Str::random(20),
                'created_at' => Carbon::now()->subDays(rand(0, 30))
            ]);
        }
    }
}
