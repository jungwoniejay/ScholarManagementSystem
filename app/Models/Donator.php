<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    use HasFactory;

    protected $primaryKey = 'donator_id';

    protected $fillable = [
        'user_id',
        'organization_name',
        'contact_person',
        'email',
        'contact_number',
        'total_fund',
        'available_fund',
        'account_status',
    ];

    protected $casts = [
        'total_fund' => 'decimal:2',
        'available_fund' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scholarships()
    {
        return $this->belongsToMany(Scholarship::class, 'donator_scholarship', 'donator_id', 'scholarship_id');
    }
}
