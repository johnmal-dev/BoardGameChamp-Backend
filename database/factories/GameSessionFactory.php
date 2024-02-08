<?php

namespace Database\Factories;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'game_session_date' => now(),
            'game_id' => function (array $attributes) {
                return $attributes['game_id'] ?? Game::factory()->create()->id;
            },
        ];
    }
}
