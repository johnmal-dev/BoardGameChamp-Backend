<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SessionPlayerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_session_player()
    {
        $user = User::factory()->create();
        $game = Game::factory()->create();
        $gameSession = GameSession::factory()->create([
            'game_id' => $game->id,
        ]);

        $sessionPlayerData = [
            'user_id' => $user->id,
            'game_session_id' => $gameSession->id,
            'game_id' => $game->id,
            'ranking' => 4,
        ];

        $response = $this->post('/api/session-players', $sessionPlayerData);

        $response
            ->assertStatus(201)
            ->assertJson($sessionPlayerData);

        $this->assertDatabaseHas('session_players', $sessionPlayerData);
    }

    /** @test */
    public function it_returns_an_error_if_info_is_missing()
    {
        $response = $this->post('/api/session-players', []);

        $response
            ->assertStatus(400)
            ->assertJson(['error' => 'Game session ID, game ID, ranking and user ID are required']);
    }
}
