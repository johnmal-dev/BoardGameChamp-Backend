<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_can_create_a_game()
    {
        $gameData = [
            'game_name'         => 'Super Mario Bros.',
            'game_description'  => 'A classic game.',
            'game_image'        => 'https://via.placeholder.com/150',
            'game_url'          => 'https://via.placeholder.com/150',
            'game_min_players'  => 1,
            'game_max_players'  => 4,
            'game_min_playtime' => 1,
            'game_max_playtime' => 60,
        ];

        $this->postJson(route('games.store'), $gameData)
            ->assertStatus(201)
            ->assertJson($gameData);

        $this->assertDatabaseHas('games', [
            'game_name' => 'Super Mario Bros.',
        ]);
    }
}
