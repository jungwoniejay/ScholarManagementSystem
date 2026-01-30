<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_type',       // Application Logs, Approval History, etc.
        'related_id',     // ID of related record
        'user_id',        // Admin/User who made the action
        'description',    // Description of the action
        'created_at',     // Optional if using timestamps
    ];

    public $timestamps = true;
}
