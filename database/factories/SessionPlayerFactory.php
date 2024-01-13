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
        $user = User::factory()->create();
        $game = Game::factory()->create();
        $game_session = GameSession::factory()->create([
            'game_id' => $game->id,
        ]);

        return [
            'game_session_id' => $game_session->id,
            'game_id' => $game->id,
            'user_id' => $user->id,
        ];
    }
}
