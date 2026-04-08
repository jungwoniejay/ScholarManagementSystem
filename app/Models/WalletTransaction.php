<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'student_wallet_id', 'type', 'amount', 'status',
        'description', 'method', 'account_name', 'account_number',
        'bank_name', 'application_id',
    ];

    protected $casts = ['amount' => 'decimal:2'];

    public function wallet()
    {
        return $this->belongsTo(StudentWallet::class, 'student_wallet_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
