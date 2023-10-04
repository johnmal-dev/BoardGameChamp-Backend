<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'game_date'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
