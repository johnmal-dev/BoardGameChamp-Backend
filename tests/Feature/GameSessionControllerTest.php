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
    public function it_can_get_all_game_sessions_sorted_by_game_date(): void
    {
        $game = Game::factory()->create();

        $gameSessions = GameSession::factory()->count(3)->create();

        $response = $this->get('/api/game-sessions');

        $expectedData = $gameSessions->sortBy('game_date')->values()->toArray();

        $response
            ->assertStatus(200)
            ->assertJson($expectedData);
    }

//    /** @test */
//    public function it_can_create_a_game_session(): void
//    {
//        $gameSessionData = [
//            'game_id' => 1,
//            'game_date' => '2021-01-01',
//        ];
//
//        $response = $this->post('/api/game-sessions', $gameSessionData);
//
//        $response
//            ->assertStatus(201);
//
//        $this->assertDatabaseHas('game_sessions', $gameSessionData);
//    }
//
//    /** @test */
//    public function it_returns_an_error_if_required_input_is_missing(): void
//    {
//        $response = $this->post('/api/game-sessions', ['game_id' => 1]);
//
//        $response->assertStatus(400)
//            ->assertJson(['error' => 'Game ID and game date are required']);
//    }
}
