<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_session_id'
    ];
}
