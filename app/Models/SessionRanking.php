<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_player_id',
        'game_id',
        'session_rank',
    ];
}
