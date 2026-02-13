<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name',
        'email',
        'amount',
        'method',
        'message',
        'donation_date'
    ];
}
