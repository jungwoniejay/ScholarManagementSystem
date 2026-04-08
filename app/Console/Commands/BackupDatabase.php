<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature   = 'db:backup';
    protected $description = 'Create a timestamped MySQL database backup in storage/backups/';

    public function handle(): int
    {
        $db       = config('database.connections.mysql.database');
        $user     = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port', 3306);

        $filename  = 'backup_' . $db . '_' . now()->format('Y-m-d_His') . '.sql';
        $directory = storage_path('backups');
        $filepath  = $directory . DIRECTORY_SEPARATOR . $filename;

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $passwordFlag = $password ? '-p' . escapeshellarg($password) : '';
        $command = sprintf(
            'mysqldump -h %s -P %s -u %s %s %s > %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($user),
            $passwordFlag,
            escapeshellarg($db),
            escapeshellarg($filepath)
        );

        exec($command, $output, $exitCode);

        if ($exitCode !== 0) {
            $this->error("Backup failed. Exit code: {$exitCode}");
            \Log::error('Database backup failed.', ['exit_code' => $exitCode]);
            return self::FAILURE;
        }

        // Keep only the last 7 backups
        $backups = glob($directory . DIRECTORY_SEPARATOR . 'backup_*.sql');
        if (count($backups) > 7) {
            usort($backups, fn($a, $b) => filemtime($a) - filemtime($b));
            foreach (array_slice($backups, 0, count($backups) - 7) as $old) {
                unlink($old);
            }
        }

        $this->info("Backup saved: {$filename}");
        \Log::info("Database backup created: {$filename}");

        return self::SUCCESS;
    }
}
