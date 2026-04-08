<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class ActivityMonitor
{
    /**
     * Suspicion thresholds
     */
    const FAILED_LOGIN_THRESHOLD = 3;
    const RAPID_ACTION_THRESHOLD = 10;
    const SESSION_HIJACK_THRESHOLD = 2;

    /**
     * Log a user activity
     */
    public function log(
        string $logType,
        string $description,
        ?User $user = null,
        ?string $subjectType = null,
        ?int $subjectId = null,
        ?array $properties = [],
        ?bool $isSuspicious = false,
        ?string $suspicionReason = null
    ): ActivityLog {
        $request = request();
        $agent = new Agent();

        return ActivityLog::create([
            'user_id' => $user?->id ?? auth()->id(),
            'log_type' => $logType,
            'description' => $description,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'properties' => !empty($properties) ? json_encode($properties) : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
            'device' => $agent->device() . ' (' . $agent->platform() . ')',
            'location' => $this->getIPLocation($request->ip()),
            'is_suspicious' => $isSuspicious,
            'suspicion_reason' => $suspicionReason,
            'occurred_at' => now(),
        ]);
    }

    /**
     * Log a login attempt
     */
    public function logLogin(User $user, bool $success = true, ?string $reason = null): ActivityLog
    {
        $isSuspicious = !$success || $this->checkSuspiciousLogin($user);
        
        return $this->log(
            logType: $success ? 'login' : 'failed_login',
            description: $success ? "User logged in successfully" : "Failed login attempt",
            user: $user,
            isSuspicious: $isSuspicious,
            suspicionReason: $isSuspicious ? ($reason ?? $this->getSuspicionReason()) : null
        );
    }

    /**
     * Log a logout
     */
    public function logLogout(User $user): ActivityLog
    {
        return $this->log(
            logType: 'logout',
            description: 'User logged out',
            user: $user
        );
    }

    /**
     * Log a CRUD action
     */
    public function logAction(
        string $action,
        string $description,
        ?string $subjectType = null,
        ?int $subjectId = null,
        ?array $properties = []
    ): ActivityLog {
        $isSuspicious = $this->checkSuspiciousAction($action, $subjectType, $properties);
        
        return $this->log(
            logType: $action,
            description: $description,
            subjectType: $subjectType,
            subjectId: $subjectId,
            properties: $properties,
            isSuspicious: $isSuspicious,
            suspicionReason: $isSuspicious ? $this->getSuspicionReason() : null
        );
    }

    /**
     * Log viewing sensitive information
     */
    public function logSensitiveView(string $resourceType, int $resourceId, ?array $properties = []): ActivityLog
    {
        return $this->log(
            logType: 'view',
            description: "Viewed sensitive {$resourceType} (ID: {$resourceId})",
            subjectType: $resourceType,
            subjectId: $resourceId,
            properties: array_merge(['sensitive' => true], $properties ?? [])
        );
    }

    /**
     * Check for suspicious login patterns
     */
    protected function checkSuspiciousLogin(User $user): bool
    {
        $ip = request()->ip();
        
        // Check for multiple failed logins in the last 5 minutes
        $failedLogins = ActivityLog::where('user_id', $user->id)
            ->where('log_type', 'failed_login')
            ->where('occurred_at', '>=', now()->subMinutes(5))
            ->count();
        
        if ($failedLogins >= self::FAILED_LOGIN_THRESHOLD) {
            return true;
        }
        
        // Check for logins from different locations in short time
        $recentLogins = ActivityLog::where('user_id', $user->id)
            ->where('log_type', 'login')
            ->where('occurred_at', '>=', now()->subHour())
            ->whereNotNull('location')
            ->where('location', '!=', $this->getIPLocation($ip))
            ->count();
        
        if ($recentLogins > 0) {
            return true;
        }
        
        // Check for logins from multiple IPs in short time (session hijack detection)
        $recentIps = ActivityLog::where('user_id', $user->id)
            ->where('log_type', 'login')
            ->where('occurred_at', '>=', now()->subMinutes(10))
            ->distinct('ip_address')
            ->count('ip_address');
        
        if ($recentIps >= self::SESSION_HIJACK_THRESHOLD) {
            return true;
        }
        
        return false;
    }

    /**
     * Check for suspicious actions
     */
    protected function checkSuspiciousAction(string $action, ?string $subjectType, ?array $properties): bool
    {
        // Check for bulk deletions
        if ($action === 'delete' && isset($properties['bulk']) && $properties['bulk'] === true) {
            return true;
        }
        
        // Check for rapid successive actions
        $recentActions = ActivityLog::where('user_id', auth()->id())
            ->where('log_type', $action)
            ->where('occurred_at', '>=', now()->subMinutes(1))
            ->count();
        
        if ($recentActions >= self::RAPID_ACTION_THRESHOLD) {
            return true;
        }
        
        // Check for accessing admin sections by non-admin users
        if (isset($properties['section']) && $properties['section'] === 'admin') {
            $user = auth()->user();
            if ($user && !$user->hasRole('admin')) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get suspicion reason based on current context
     */
    protected function getSuspicionReason(): ?string
    {
        $ip = request()->ip();
        $location = $this->getIPLocation($ip);
        
        // Check for multiple failed logins
        $failedLogins = ActivityLog::where('user_id', auth()->id())
            ->where('log_type', 'failed_login')
            ->where('occurred_at', '>=', now()->subMinutes(5))
            ->count();
        
        if ($failedLogins >= self::FAILED_LOGIN_THRESHOLD) {
            return "Multiple failed login attempts ({$failedLogins} in 5 minutes)";
        }
        
        // Check for unusual location
        $recentLocations = ActivityLog::where('user_id', auth()->id())
            ->where('log_type', 'login')
            ->where('occurred_at', '>=', now()->subHour())
            ->pluck('location')
            ->filter()
            ->unique();
        
        if ($recentLocations->isNotEmpty() && !$recentLocations->contains($location)) {
            return "Login from unusual location: {$location}";
        }
        
        // Check for rapid actions
        $userId = auth()->id();
        $recentActions = ActivityLog::where('user_id', $userId)
            ->where('occurred_at', '>=', now()->subMinutes(1))
            ->count();
        
        if ($recentActions >= self::RAPID_ACTION_THRESHOLD) {
            return "Unusually high activity rate ({$recentActions} actions in 1 minute)";
        }
        
        // Check for session hijack
        $recentIps = ActivityLog::where('user_id', $userId)
            ->where('log_type', 'login')
            ->where('occurred_at', '>=', now()->subMinutes(10))
            ->distinct('ip_address')
            ->count('ip_address');
        
        if ($recentIps >= self::SESSION_HIJACK_THRESHOLD) {
            return "Possible session hijack ({$recentIps} different IPs in 10 minutes)";
        }
        
        return "Unusual activity detected";
    }

    /**
     * Get IP location (simplified - in production use a real geolocation service)
     */
    protected function getIPLocation(?string $ip): ?string
    {
        if (!$ip) {
            return null;
        }
        
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            if (preg_match('/^(10\.|172\.(1[6-9]|2[0-9]|3[0-1])\.|192\.168\.)/', $ip)) {
                return 'Local Network';
            }
            return 'External Network';
        }
        
        return 'Unknown';
    }

    /**
     * Get activity statistics
     */
    public function getActivityStats(?int $days = 7): array
    {
        $startDate = now()->subDays($days);
        
        // Total activities by type
        $activitiesByType = ActivityLog::where('occurred_at', '>=', $startDate)
            ->select('log_type', DB::raw('count(*) as count'))
            ->groupBy('log_type')
            ->pluck('count', 'log_type');
        
        // Suspicious activities count
        $suspiciousCount = ActivityLog::where('occurred_at', '>=', $startDate)
            ->where('is_suspicious', true)
            ->count();
        
        // Active users count
        $activeUsers = ActivityLog::where('occurred_at', '>=', $startDate)
            ->distinct('user_id')
            ->count('user_id');
        
        // Activities by day (for chart)
        $dailyActivities = ActivityLog::where('occurred_at', '>=', $startDate)
            ->select(DB::raw('DATE(occurred_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Top active users
        $topActiveUsers = ActivityLog::where('occurred_at', '>=', $startDate)
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        
        // Failed login attempts
        $failedLogins = ActivityLog::where('occurred_at', '>=', $startDate)
            ->where('log_type', 'failed_login')
            ->count();
        
        // Unique IP addresses
        $uniqueIps = ActivityLog::where('occurred_at', '>=', $startDate)
            ->distinct('ip_address')
            ->count('ip_address');
        
        // Peak activity hour
        $peakHour = ActivityLog::where('occurred_at', '>=', $startDate)
            ->select(DB::raw('HOUR(occurred_at) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderByDesc('count')
            ->first();
        
        return [
            'total_activities' => array_sum($activitiesByType->toArray()),
            'activities_by_type' => $activitiesByType->toArray(),
            'suspicious_count' => $suspiciousCount,
            'active_users' => $activeUsers,
            'daily_activities' => $dailyActivities,
            'top_active_users' => $topActiveUsers,
            'failed_logins' => $failedLogins,
            'unique_ips' => $uniqueIps,
            'peak_hour' => $peakHour ? $peakHour->hour : null,
        ];
    }

    /**
     * Get recent suspicious activities
     */
    public function getRecentSuspicious(?int $limit = 10)
    {
        return ActivityLog::suspicious()
            ->with('user')
            ->orderByDesc('occurred_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities by user
     */
    public function getUserActivities(int $userId, ?int $limit = 50)
    {
        return ActivityLog::forUser($userId)
            ->with('subject')
            ->orderByDesc('occurred_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get security summary for dashboard
     */
    public function getSecuritySummary(): array
    {
        $today = now()->startOfDay();
        $weekAgo = now()->subDays(7);
        
        // Today's stats
        $todayTotal = ActivityLog::whereDate('occurred_at', $today)->count();
        $todaySuspicious = ActivityLog::whereDate('occurred_at', $today)
            ->where('is_suspicious', true)
            ->count();
        $todayFailedLogins = ActivityLog::whereDate('occurred_at', $today)
            ->where('log_type', 'failed_login')
            ->count();
        
        // Week stats
        $weekTotal = ActivityLog::whereBetween('occurred_at', [$weekAgo, now()])->count();
        $weekSuspicious = ActivityLog::whereBetween('occurred_at', [$weekAgo, now()])
            ->where('is_suspicious', true)
            ->count();
        
        // Calculate trends
        $suspiciousTrend = $weekTotal > 0 ? round(($weekSuspicious / $weekTotal) * 100, 2) : 0;
        
        // Users with suspicious activity
        $suspiciousUsers = ActivityLog::whereBetween('occurred_at', [$weekAgo, now()])
            ->where('is_suspicious', true)
            ->distinct('user_id')
            ->count('user_id');
        
        return [
            'today_total' => $todayTotal,
            'today_suspicious' => $todaySuspicious,
            'today_failed_logins' => $todayFailedLogins,
            'week_total' => $weekTotal,
            'week_suspicious' => $weekSuspicious,
            'suspicious_trend' => $suspiciousTrend,
            'suspicious_users' => $suspiciousUsers,
        ];
    }

    /**
     * Clean up old activity logs
     */
    public function cleanupOldLogs(int $daysToKeep = 90): int
    {
        return ActivityLog::where('occurred_at', '<', now()->subDays($daysToKeep))
            ->delete();
    }

    /**
     * Get activity heatmap data (activities by hour and day of week)
     */
    public function getActivityHeatmap(?int $days = 30): array
    {
        $startDate = now()->subDays($days);
        
        $heatmap = ActivityLog::where('occurred_at', '>=', $startDate)
            ->select(
                DB::raw('DAYOFWEEK(occurred_at) as day_of_week'),
                DB::raw('HOUR(occurred_at) as hour'),
                DB::raw('count(*) as count')
            )
            ->groupBy('day_of_week', 'hour')
            ->get();
        
        $data = [];
        foreach ($heatmap as $row) {
            $data[$row->day_of_week][$row->hour] = $row->count;
        }
        
        return $data;
    }
}