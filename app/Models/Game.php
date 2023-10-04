<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'game_description',
        'game_image',
        'game_url',
        'game_min_players',
        'game_max_players',
        'game_min_playtime',
        'game_max_playtime',
    ];

    public function players() : HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            SessionPlayer::class,
            'game_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function gameSessions(): HasMany
    {
        return $this->hasMany(GameSession::class);
    }

    public function sessionRankings(): HasMany
    {
        return $this->hasMany(SessionRanking::class);
    }
}
