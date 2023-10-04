<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_player_id',
        'game_id',
        'session_rank',
    ];

    public function sessionPlayer(): BelongsTo
    {
        return $this->belongsTo(SessionPlayer::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
