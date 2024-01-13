<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionPlayerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'game_id' => 1,
            'game_session_id' => 1,
            'ranking' => rand(1, 5),
        ];
    }
}
