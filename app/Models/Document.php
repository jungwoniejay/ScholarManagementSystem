<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'name',
        'file_path',
        'status',
        'verified_at',
        'verified_by',
        'remarks',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
