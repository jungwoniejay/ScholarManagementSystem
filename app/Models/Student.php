<?php

namespace App\Models;

use App\Models\Donator;
use App\Models\StudentWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'enrollment_year',
        'course',
        'gpa',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'gpa' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function wallet()
    {
        return $this->hasOne(StudentWallet::class);
    }

    public function getOrCreateWallet(): StudentWallet
    {
        return $this->wallet ?? $this->wallet()->create([
            'balance'         => 0,
            'total_received'  => 0,
            'total_withdrawn' => 0,
        ]);
    }
}
