<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title', 'body', 'type', 'is_active',
        'show_on_landing', 'show_on_student_dashboard',
        'starts_at', 'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_landing' => 'boolean',
        'show_on_student_dashboard' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()));
    }
}
