<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'eligibility_criteria',
        'application_deadline',
        'status',
        'max_recipients',
        'academic_year',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'application_deadline' => 'date',
        'max_recipients' => 'integer',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function donators()
    {
        return $this->belongsToMany(Donator::class, 'donator_scholarship', 'scholarship_id', 'donator_id');
    }
}
