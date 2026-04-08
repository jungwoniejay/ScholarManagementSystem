<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_type',
        'description',
        'subject_type',
        'subject_id',
        'properties',
        'ip_address',
        'user_agent',
        'browser',
        'device',
        'location',
        'is_suspicious',
        'suspicion_reason',
        'occurred_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'subject_id' => 'integer',
        'properties' => 'array',
        'is_suspicious' => 'boolean',
        'occurred_at' => 'datetime',
    ];

    /**
     * Get the user who performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject model (polymorphic)
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope for suspicious activities
     */
    public function scopeSuspicious($query)
    {
        return $query->where('is_suspicious', true);
    }

    /**
     * Scope for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for a specific log type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('log_type', $type);
    }

    /**
     * Scope for date range
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('occurred_at', [$startDate, $endDate]);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('description', 'like', "%{$search}%")
              ->orWhere('ip_address', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('log_type', 'like', "%{$search}%")
              ->orWhere('suspicion_reason', 'like', "%{$search}%");
        });
    }

    /**
     * Get formatted occurred time
     */
    public function getFormattedOccurredAtAttribute(): string
    {
        return $this->occurred_at->format('M d, Y H:i:s');
    }

    /**
     * Get human-readable time difference
     */
    public function getHumanReadableTimeAttribute(): string
    {
        return $this->occurred_at->diffForHumans();
    }

    /**
     * Get icon for log type
     */
    public function getIconAttribute(): string
    {
        return match($this->log_type) {
            'login' => 'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1',
            'logout' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
            'create' => 'M12 4v16m8-8H4',
            'update' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'delete' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
            'view' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z',
            'failed_login' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            'suspicious' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            default => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        };
    }

    /**
     * Get color class for log type
     */
    public function getColorClassAttribute(): string
    {
        if ($this->is_suspicious) {
            return 'red';
        }

        return match($this->log_type) {
            'login' => 'green',
            'logout' => 'gray',
            'create' => 'blue',
            'update' => 'yellow',
            'delete' => 'red',
            'view' => 'indigo',
            'failed_login' => 'orange',
            default => 'gray',
        };
    }

    /**
     * Get badge class for log type
     */
    public function getBadgeClassAttribute(): string
    {
        if ($this->is_suspicious) {
            return 'bg-red-100 text-red-800';
        }

        return match($this->log_type) {
            'login' => 'bg-green-100 text-green-800',
            'logout' => 'bg-gray-100 text-gray-800',
            'create' => 'bg-blue-100 text-blue-800',
            'update' => 'bg-yellow-100 text-yellow-800',
            'delete' => 'bg-red-100 text-red-800',
            'view' => 'bg-indigo-100 text-indigo-800',
            'failed_login' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}