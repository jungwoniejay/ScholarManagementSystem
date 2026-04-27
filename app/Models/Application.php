<?php

namespace App\Models;

use App\Models\Donator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'scholarship_id',
        'donator_id',
        'status',
        'donor_status',
        'donor_remarks',
        'donor_reviewed_at',
        'student_response',
        'student_responded_at',
        'disbursed_at',
        'disbursed_by',
        'applied_at',
        'reviewed_at',
        'awarded_amount',
        'ai_score',
        'personal_statement',
        'notified',
        'remarks',
    ];

    protected $casts = [
        'applied_at'           => 'datetime',
        'reviewed_at'          => 'datetime',
        'donor_reviewed_at'    => 'datetime',
        'student_responded_at' => 'datetime',
        'disbursed_at'         => 'datetime',
        'disbursed_by'         => 'integer',
        'awarded_amount'       => 'decimal:2',
        'ai_score'             => 'decimal:2',
        'notified'             => 'boolean',
    ];

    public function donator()
    {
        return $this->belongsTo(Donator::class, 'donator_id', 'donator_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
