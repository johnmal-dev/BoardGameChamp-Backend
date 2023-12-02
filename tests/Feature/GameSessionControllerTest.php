<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_game_sessions_sorted_by_game_date(): void
    {
        $gameSessions = GameSession::factory()
            ->count(3)
            ->sequence(
                ['game_date' => now()->subDay(2)->toDateTimeString()],
                ['game_date' => now()->subDay(1)->toDateTimeString()],
                ['game_date' => now()->toDateTimeString()]
            )
            ->create();

        $response     = $this->get('/api/game-sessions');
        $expectedData = $gameSessions
            ->sortBy('game_date', null, true)
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
            'game_date' => now()->toDateString(),
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
            'game_date' => now()->subDay()->toDateTimeString(),
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
}
