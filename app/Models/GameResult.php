<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GameResult extends Model
{
    use HasFactory;

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    // get game name from game_id
    public function game(): HasOne
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
