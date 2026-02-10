<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'criteria_type',
        'criteria_value',
        'is_system_default',
    ];

    protected $casts = [
        'is_system_default' => 'boolean',
    ];
}
