<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use App\Services\ActivityMonitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class ActivityController extends Controller
{
    protected ActivityMonitor $activityMonitor;

    public function __construct(ActivityMonitor $activityMonitor)
    {
        $this->activityMonitor = $activityMonitor;
    }

    /**
     * Display the activity monitoring dashboard
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $search = $request->get('search', '');
        $userFilter = $request->get('user', '');
        $typeFilter = $request->get('type', '');
        $suspiciousOnly = $request->get('suspicious', false);
        $dateFrom = $request->get('date_from', now()->subDays(7)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));
        $perPage = $request->get('per_page', 25);

        // Build query
        $query = ActivityLog::with('user')
            ->orderByDesc('occurred_at');

        // Apply filters
        if ($search) {
            $query->search($search);
        }

        if ($userFilter) {
            $query->forUser($userFilter);
        }

        if ($typeFilter) {
            $query->ofType($typeFilter);
        }

        if ($suspiciousOnly) {
            $query->suspicious();
        }

        if ($dateFrom && $dateTo) {
            $query->betweenDates($dateFrom . ' 00:00:00', $dateTo . ' 23:59:59');
        }

        // Get paginated results
        $activities = $query->paginate($perPage)->withQueryString();

        // Get statistics
        $stats = $this->activityMonitor->getActivityStats(7);

        // Get recent suspicious activities
        $suspiciousActivities = $this->activityMonitor->getRecentSuspicious(5);

        // Get security summary
        $securitySummary = $this->activityMonitor->getSecuritySummary();

        // Get all users for filter dropdown
        $users = User::select('id', 'name', 'email')->get();

        // Get activity types for filter
        $activityTypes = [
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Create',
            'update' => 'Update',
            'delete' => 'Delete',
            'view' => 'View',
            'failed_login' => 'Failed Login',
            'suspicious' => 'Suspicious',
        ];

        // Get chart data
        $chartData = $this->prepareChartData($stats['daily_activities'] ?? []);

        // Get top active users for sidebar
        $topActiveUsers = $stats['top_active_users'] ?? collect();

        return view('admin.activity.index', compact(
            'activities',
            'stats',
            'suspiciousActivities',
            'securitySummary',
            'users',
            'activityTypes',
            'chartData',
            'topActiveUsers',
            'search',
            'userFilter',
            'typeFilter',
            'suspiciousOnly',
            'dateFrom',
            'dateTo',
            'perPage'
        ));
    }

    /**
     * Show details of a specific activity
     */
    public function show(ActivityLog $activity)
    {
        $activity->load('user', 'subject');
        return view('admin.activity.show', compact('activity'));
    }

    /**
     * Export activities to CSV
     */
    public function exportCsv(Request $request)
    {
        $activities = $this->getFilteredActivities($request);

        $filename = 'activity_log_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($activities) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, [
                'ID',
                'User',
                'Email',
                'Activity Type',
                'Description',
                'IP Address',
                'Browser',
                'Device',
                'Location',
                'Suspicious',
                'Suspicion Reason',
                'Occurred At',
            ]);

            // Data rows
            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity->id,
                    $activity->user?->name ?? 'N/A',
                    $activity->user?->email ?? 'N/A',
                    ucfirst(str_replace('_', ' ', $activity->log_type)),
                    $activity->description,
                    $activity->ip_address ?? 'N/A',
                    $activity->browser ?? 'N/A',
                    $activity->device ?? 'N/A',
                    $activity->location ?? 'N/A',
                    $activity->is_suspicious ? 'Yes' : 'No',
                    $activity->suspicion_reason ?? '',
                    $activity->occurred_at->toDateTimeString(),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export activities to JSON
     */
    public function exportJson(Request $request)
    {
        $activities = $this->getFilteredActivities($request);

        $export = [
            'exported_at' => now()->toDateTimeString(),
            'total_records' => $activities->count(),
            'activities' => $activities->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'user' => [
                        'id' => $activity->user_id,
                        'name' => $activity->user?->name,
                        'email' => $activity->user?->email,
                    ],
                    'log_type' => $activity->log_type,
                    'description' => $activity->description,
                    'subject' => [
                        'type' => $activity->subject_type,
                        'id' => $activity->subject_id,
                    ],
                    'ip_address' => $activity->ip_address,
                    'browser' => $activity->browser,
                    'device' => $activity->device,
                    'location' => $activity->location,
                    'is_suspicious' => $activity->is_suspicious,
                    'suspicion_reason' => $activity->suspicion_reason,
                    'occurred_at' => $activity->occurred_at->toDateTimeString(),
                ];
            }),
        ];

        $filename = 'activity_log_' . date('Y-m-d_His') . '.json';

        return response()
            ->json($export)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Get filtered activities based on request
     */
    protected function getFilteredActivities(Request $request)
    {
        $query = ActivityLog::with('user');

        $search = $request->get('search', '');
        $userFilter = $request->get('user', '');
        $typeFilter = $request->get('type', '');
        $suspiciousOnly = $request->get('suspicious', false);
        $dateFrom = $request->get('date_from', now()->subDays(7)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        if ($search) {
            $query->search($search);
        }

        if ($userFilter) {
            $query->forUser($userFilter);
        }

        if ($typeFilter) {
            $query->ofType($typeFilter);
        }

        if ($suspiciousOnly) {
            $query->suspicious();
        }

        if ($dateFrom && $dateTo) {
            $query->betweenDates($dateFrom . ' 00:00:00', $dateTo . ' 23:59:59');
        }

        return $query->orderByDesc('occurred_at')->get();
    }

    /**
     * Prepare chart data for the dashboard
     */
    protected function prepareChartData($dailyActivities)
    {
        $labels = [];
        $data = [];
        $suspiciousData = [];

        foreach ($dailyActivities as $activity) {
            $labels[] = date('M d', strtotime($activity->date));
            $data[] = $activity->count;
            
            // Get suspicious count for the same day
            $suspiciousCount = ActivityLog::whereDate('occurred_at', $activity->date)
                ->where('is_suspicious', true)
                ->count();
            $suspiciousData[] = $suspiciousCount;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'suspicious_data' => $suspiciousData,
        ];
    }

    /**
     * Get activity summary for dashboard widgets
     */
    public function summary()
    {
        $today = now()->startOfDay();
        
        $todayActivities = ActivityLog::whereDate('occurred_at', $today)->count();
        $todaySuspicious = ActivityLog::whereDate('occurred_at', $today)
            ->where('is_suspicious', true)
            ->count();
        
        $weekActivities = ActivityLog::whereBetween('occurred_at', [
            now()->subDays(7),
            now()
        ])->count();
        
        $recentSuspicious = $this->activityMonitor->getRecentSuspicious(10);
        
        // Get activities by type for the past week
        $activitiesByType = ActivityLog::whereBetween('occurred_at', [
            now()->subDays(7),
            now()
        ])
            ->select('log_type', DB::raw('count(*) as count'))
            ->groupBy('log_type')
            ->pluck('count', 'log_type');

        return response()->json([
            'today_activities' => $todayActivities,
            'today_suspicious' => $todaySuspicious,
            'week_activities' => $weekActivities,
            'recent_suspicious' => $recentSuspicious,
            'activities_by_type' => $activitiesByType,
        ]);
    }
}