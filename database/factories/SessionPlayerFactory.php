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
            'user_id' => User::factory()->create()->id,
            'game_id' =>  Game::factory()->create()->id,
            'game_session_id' => GameSession::factory()->create()->id,
            'ranking' => rand(1, 5),
        ];
    }
}
