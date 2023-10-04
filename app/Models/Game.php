<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
