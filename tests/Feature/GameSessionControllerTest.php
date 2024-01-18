<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_game_sessions_sorted_by_game_session_date(): void
    {
        $gameSessions = GameSession::factory()
            ->count(3)
            ->sequence(
                ['game_session_date' => now()->subDay(2)->toDateTimeString()],
                ['game_session_date' => now()->subDay(1)->toDateTimeString()],
                ['game_session_date' => now()->toDateTimeString()]
            )
            ->create();

        $response     = $this->get('/api/game-sessions');
        $expectedData = $gameSessions
            ->sortBy('game_session_date', null, true)
            ->values()
            ->toArray();

        $response
            ->assertStatus(200)
            ->assertJson($expectedData);
    }

    /** @test */
    public function it_can_create_a_game_session(): void
    {
        $gameSessionData = [
            'game_id'   => Game::factory()->create()->id,
            'game_session_date' => now()->toDateString(),
        ];

        $this->post('/api/game-sessions', $gameSessionData)
            ->assertStatus(201)
            ->assertJson(
                GameSession::query()
                    ->with('game')
                    ->first()
                    ->toArray()
            );

        $this->assertDatabaseHas('game_sessions', $gameSessionData);
    }

    /** @test */
    public function it_returns_an_error_if_required_input_is_missing(): void
    {
        $response = $this->post('/api/game-sessions', ['game_id' => 1]);

        $response->assertStatus(400)
            ->assertJson(['error' => 'Game ID and game date are required']);
    }

    /** @test */
    public function it_can_get_a_game_session_by_id(): void
    {
        $gameSession = GameSession::factory()->create();

        $response = $this->get("/api/game-sessions/{$gameSession->id}");

        $response->assertStatus(200)
            ->assertJson($gameSession->toArray());
    }

    /** @test */
    public function it_fails_if_the_game_session_does_not_exist(): void
    {
        $response = $this->get('/api/game-sessions/1000');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Game session not found']);
    }

    /** @test */
    public function it_can_update_a_game_session(): void
    {
        $gameSession = GameSession::factory()->create();

        $response = $this->put("/api/game-sessions/{$gameSession->id}", [
            'game_id'   => Game::factory()->create()->id,
            'game_session_date' => now()->subDay()->toDateTimeString(),
        ]);

        $response->assertStatus(200)
            ->assertJson(
                GameSession::query()
                    ->with('game')
                    ->first()
                    ->toArray()
            );
    }

    /** @test */
    public function it_can_delete_a_game_session(): void
    {
        $gameSession = GameSession::factory()->create();

        $response = $this->delete("/api/game-sessions/{$gameSession->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('game_sessions', ['id' => $gameSession->id]);
    }

    /** @test */
    public function it_cascade_deletes_connected_session_players_when_deleting_a_game_session(): void
    {
        $game = Game::factory()->create();
        $gameSession = GameSession::factory()->create();
        $gameSession->sessionPlayers()->createMany(
            [
                [
                    'user_id' => $user1Id = User::factory()->create()->id,
                    'game_id' => $game->id,
                    'ranking' => 1,
                ],
                [
                    'user_id' => $user2Id = User::factory()->create()->id,
                    'game_id' => $game->id,
                    'ranking' => 2,
                ],
            ]
        );

        $this->assertDatabaseHas('session_players', ['user_id' => $user1Id]);
        $this->assertDatabaseHas('session_players', ['user_id' => $user2Id]);

        $this->delete("/api/game-sessions/{$gameSession->id}");

        $this->assertDatabaseMissing('session_players', ['user_id' => $user1Id]);
        $this->assertDatabaseMissing('session_players', ['user_id' => $user2Id]);
    }

    /** @test */
    public function it_can_store_new_game_session_and_session_players_with_new_game_session_endpoint()
    {
        $incomingData = [
            'game_session_date' => now()->toDateString(),
            'session_player_ids' => [1, 2, 3]
        ];

        $response = $this->post('/api/new-game-session', $incomingData);

        $this->assertDatabaseHas('game_sessions', [
            'game_id' => 1,
            'game_session_date' => $incomingData['game_session_date'],
        ]);
//        $this->assertDatabaseHas('session_players', [
//            'user_id' => $user->id,
//            'game_session_id' => GameSession::query()->first()->id,
//            'game_id' => $game->id,
//        ]);
    }
}
