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
        'approval_status',
        'max_recipients',
        'academic_year',
    ];

    protected $casts = [
        'amount'               => 'decimal:2',
        'application_deadline' => 'date',
        'max_recipients'       => 'integer',
    ];

    public function isFullyFunded(): bool
    {
        if (!$this->max_recipients) return false;
        $approved = $this->applications()
            ->whereIn('status', ['completed', 'approved'])
            ->count();
        return $approved >= $this->max_recipients;
    }

    public function isAcceptingApplications(): bool
    {
        return $this->approval_status === 'approved'
            && $this->status === 'active'
            && (!$this->application_deadline || !$this->application_deadline->isPast())
            && !$this->isFullyFunded();
    }

    public function getFundingProgressAttribute(): float
    {
        $total = ($this->amount ?? 0) * ($this->max_recipients ?? 1);
        if ($total <= 0) return 0;
        return min(100, ($this->getTotalFundedAttribute() / $total) * 100);
    }

    public function getTotalFundedAttribute(): float
    {
        return (float) $this->applications()
            ->whereIn('status', ['completed', 'approved'])
            ->sum('awarded_amount');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function donators()
    {
        return $this->belongsToMany(Donator::class, 'donator_scholarship', 'scholarship_id', 'donator_id');
    }
}
