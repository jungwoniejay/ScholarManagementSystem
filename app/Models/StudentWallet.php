<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentWallet extends Model
{
    protected $fillable = ['student_id', 'balance', 'total_received', 'total_withdrawn'];

    protected $casts = [
        'balance'          => 'decimal:2',
        'total_received'   => 'decimal:2',
        'total_withdrawn'  => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function credit(float $amount, string $description, int $applicationId = null): WalletTransaction
    {
        $this->balance         += $amount;
        $this->total_received  += $amount;
        $this->save();

        return $this->transactions()->create([
            'type'           => 'credit',
            'amount'         => $amount,
            'status'         => 'completed',
            'description'    => $description,
            'application_id' => $applicationId,
        ]);
    }

    public function canWithdraw(float $amount): bool
    {
        return $this->balance >= $amount && $amount > 0;
    }
}
