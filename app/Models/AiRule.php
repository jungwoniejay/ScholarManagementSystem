<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiRule extends Model
{
    protected $table = 'ai_rules';

    protected $fillable = ['key', 'value'];
}
