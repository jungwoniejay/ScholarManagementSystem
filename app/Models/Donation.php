<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donator_id',
        'donor_name',
        'email',
        'amount',
        'method',
        'message',
        'donation_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donation_date' => 'date',
    ];

    /**
     * Get the donator that owns the donation.
     */
    public function donator()
    {
        return $this->belongsTo(Donator::class, 'donator_id', 'donator_id');
    }
}
