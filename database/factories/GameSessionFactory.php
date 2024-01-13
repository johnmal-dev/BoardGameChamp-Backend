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
            'game_date' => now(),
            'game_id' => 1
        ];
    }
}
