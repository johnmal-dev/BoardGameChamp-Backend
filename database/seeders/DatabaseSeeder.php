<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jc = User::factory()->create([
            'name' => 'John Malapit',
            'username' => 'johnmal',
            'email' => 'jc@mail.com',
        ]);

        $keno = User::factory()->create([
            'name' => 'Keno Aguiar',
            'username' => 'yellowboi',
            'email' => 'keno@mail.com',
        ]);

        $jeremy = User::factory()->create([
            'name' => 'Jeremy Aguiar',
            'username' => 'jayremy',
            'email' => 'jeremy@mail.com',
        ]);

        $ryan = User::factory()->create([
            'name' => 'Ryan Cortez',
            'username' => 'ryry',
            'email' => 'ryan@mail.com',
        ]);

        $kevin = User::factory()->create([
            'name' => 'Kevin Bautista',
            'username' => 'kb',
            'email' => 'kevin@mail.com',
        ]);

        $augy = User::factory()->create([
            'name' => 'Augy Lagundino',
            'username' => 'awgeeeee',
            'email' => 'augy@mail.com',
        ]);

        $game = Game::factory()->create();

        $player1 = Player::factory()->create([
            'user_id' => $jc->id,
            'game_id' => $game->id,
            'rank' => 1,
        ]);

        $player2 = Player::factory()->create([
            'user_id' => $keno->id,
            'game_id' => $game->id,
            'rank' => 2,
        ]);

        $player3 = Player::factory()->create([
            'user_id' => $jeremy->id,
            'game_id' => $game->id,
            'rank' => 3,
        ]);
    }
}
