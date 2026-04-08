<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donator_id',
        'scholarship_id',
        'donor_name',
        'email',
        'amount',
        'method',
        'message',
        'donation_date',
        'approval_status',
        'approved_at',
        'admin_remarks',
    ];

    protected $casts = [
        'amount'          => 'decimal:2',
        'donation_date'   => 'date',
        'approved_at'     => 'datetime',
    ];

    /**
     * Get the donator that owns the donation.
     */
    public function donator()
    {
        return $this->belongsTo(Donator::class, 'donator_id', 'donator_id');
    }

    public function scholarship()
    {
        return $this->belongsTo(\App\Models\Scholarship::class);
    }
}
