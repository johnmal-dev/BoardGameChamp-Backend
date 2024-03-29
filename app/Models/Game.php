<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Game extends Model
{
    use HasFactory;

    public string $game_name;
    public string $game_description;
    public string $game_image;
    public string $game_url;
    public int $game_min_players;
    public int $game_max_players;
    public int $game_min_playtime;
    public int $game_max_playtime;

    protected $guarded = [];

    public static array $rules = [
        'game_name' => 'required|string',
        'game_description' => 'string',
        'game_image' => 'string',
        'game_url' => 'string',
        'game_min_players' => 'integer',
        'game_max_players' => 'integer',
        'game_min_playtime' => 'integer',
        'game_max_playtime' => 'integer',
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

    protected static function booted(): void
    {
        static::creating(function ($game) {
            validator($game->getAttributes(), static::$rules)->validate();
        });

        static::updating(function ($game) {
            validator($game->getAttributes(), static::$rules)->validate();
        });
    }
}
