<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MaintenanceController extends Controller
{
    /**
     * Display the system maintenance page
     */
    public function index()
    {
        // Get all database tables with their row counts
        $tables = $this->getDatabaseTables();
        
        // Get cache information
        $cacheInfo = $this->getCacheInfo();
        
        // Get system information
        $systemInfo = $this->getSystemInfo();
        
        // Get recent activity logs
        $recentActivity = $this->getRecentActivity();
        
        return view('admin.maintenance.index', compact('tables', 'cacheInfo', 'systemInfo', 'recentActivity'));
    }

    /**
     * Export database tables to specified format
     */
    public function export(Request $request)
    {
        $request->validate([
            'tables' => 'required|array|min:1',
            'tables.*' => 'required|string',
            'format' => 'required|in:csv,sql,json',
        ]);

        $tables = $request->input('tables');
        $format = $request->input('format');

        try {
            switch ($format) {
                case 'csv':
                    return $this->exportAsCsv($tables);
                case 'sql':
                    return $this->exportAsSql($tables);
                case 'json':
                    return $this->exportAsJson($tables);
                default:
                    return back()->with('error', 'Invalid export format.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    /**
     * Clear system cache
     */
    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');

            return back()->with('success', 'System cache cleared successfully. The application has been refreshed.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }

    /**
     * Get all database tables with their information
     */
    private function getDatabaseTables()
    {
        $databaseName = DB::getDatabaseName();
        $tables = [];

        $rawTables = DB::select("
            SELECT 
                TABLE_NAME as table_name,
                TABLE_ROWS as row_count,
                ROUND((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024, 2) as size_mb
            FROM information_schema.TABLES 
            WHERE TABLE_SCHEMA = ?
            ORDER BY TABLE_NAME
        ", [$databaseName]);

        foreach ($rawTables as $table) {
            // Get column information for each table
            $columns = DB::select("
                SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT
                FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
                ORDER BY ORDINAL_POSITION
            ", [$databaseName, $table->table_name]);

            $tables[] = [
                'name' => $table->table_name,
                'row_count' => $table->row_count,
                'size_mb' => $table->size_mb,
                'columns' => array_map(fn($col) => [
                    'name' => $col->COLUMN_NAME,
                    'type' => $col->DATA_TYPE,
                    'nullable' => $col->IS_NULLABLE === 'YES',
                    'default' => $col->COLUMN_DEFAULT,
                ], $columns),
            ];
        }

        return $tables;
    }

    /**
     * Get cache information
     */
    private function getCacheInfo()
    {
        $cacheDriver = config('cache.default');
        $cachePrefix = config('cache.prefix');
        
        return [
            'driver' => $cacheDriver,
            'prefix' => $cachePrefix,
            'store' => config("cache.stores.{$cacheDriver}.driver", $cacheDriver),
        ];
    }

    /**
     * Get system information
     */
    private function getSystemInfo()
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'timezone' => config('app.timezone'),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
            'environment' => app()->environment(),
            'database_driver' => config('database.default'),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time') . ' seconds',
        ];
    }

    /**
     * Get recent activity from database changes
     */
    private function getRecentActivity()
    {
        $activity = [];
        
        try {
            // Check for recent applications
            $recentApplications = DB::table('applications')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
            
            foreach ($recentApplications as $app) {
                $activity[] = [
                    'type' => 'application',
                    'message' => 'New scholarship application submitted',
                    'timestamp' => $app->created_at,
                ];
            }
            
            // Check for recent donations
            $recentDonations = DB::table('donations')
                ->orderBy('created_at', 'desc')
                ->limit(2)
                ->get();
            
            foreach ($recentDonations as $donation) {
                $activity[] = [
                    'type' => 'donation',
                    'message' => 'New donation received',
                    'timestamp' => $donation->created_at,
                ];
            }
            
            // Sort by timestamp and return top 5
            usort($activity, function($a, $b) {
                return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });
            
            return array_slice($activity, 0, 5);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Export tables as CSV
     */
    private function exportAsCsv(array $tables)
    {
        $filename = 'database_export_' . date('Y-m-d_His') . '.csv';
        $content = '';
        
        foreach ($tables as $tableName) {
            $data = DB::table($tableName)->get();
            
            if ($data->isEmpty()) {
                continue;
            }

            $content .= "### TABLE: {$tableName} ###\n";
            
            // Headers
            $headers = array_keys((array)$data->first());
            $content .= implode(',', $headers) . "\n";
            
            // Rows
            foreach ($data as $row) {
                $rowArray = (array)$row;
                $escapedRow = array_map(fn($value) => '"' . str_replace('"', '""', $value ?? '') . '"', $rowArray);
                $content .= implode(',', $escapedRow) . "\n";
            }
            
            $content .= "\n";
        }

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export tables as SQL dump
     */
    private function exportAsSql(array $tables)
    {
        $filename = 'database_export_' . date('Y-m-d_His') . '.sql';
        $content = "-- Database Export\n";
        $content .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $content .= "-- Tables: " . implode(', ', $tables) . "\n\n";

        foreach ($tables as $tableName) {
            $content .= "-- Table structure for `{$tableName}`\n";
            $content .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            
            // Get table creation statement
            $createStatement = DB::select("SHOW CREATE TABLE `{$tableName}`");
            if (!empty($createStatement)) {
                $content .= $createStatement[0]->{'Create Table'} . ";\n\n";
            }

            // Get table data
            $data = DB::table($tableName)->get();
            
            if (!$data->isEmpty()) {
                $content .= "-- Data for table `{$tableName}`\n";
                $content .= "INSERT INTO `{$tableName}` (";
                
                $columns = array_keys((array)$data->first());
                $content .= implode(', ', array_map(fn($col) => "`{$col}`", $columns));
                $content .= ") VALUES\n";

                $valueSets = [];
                foreach ($data as $row) {
                    $rowArray = (array)$row;
                    $values = array_map(fn($value) => $value === null ? 'NULL' : "'" . addslashes($value) . "'", $rowArray);
                    $valueSets[] = "(" . implode(', ', $values) . ")";
                }

                $content .= implode(",\n", $valueSets) . ";\n\n";
            }
        }

        return response($content, 200, [
            'Content-Type' => 'text/sql',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export tables as JSON
     */
    private function exportAsJson(array $tables)
    {
        $filename = 'database_export_' . date('Y-m-d_His') . '.json';
        $export = [
            'exported_at' => date('Y-m-d H:i:s'),
            'database' => DB::getDatabaseName(),
            'tables' => [],
        ];

        foreach ($tables as $tableName) {
            $data = DB::table($tableName)->get();
            $export['tables'][$tableName] = [
                'row_count' => $data->count(),
                'data' => $data->toArray(),
            ];
        }

        return response(json_encode($export, JSON_PRETTY_PRINT), 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}