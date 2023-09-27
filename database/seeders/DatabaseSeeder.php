<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\Player;
use App\Models\PlayResult;
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
            'first_name' => 'John',
            'last_name' => 'Malapit',
            'username' => 'johnmal',
            'email' => 'jc@mail.com',
        ]);

        $keno = User::factory()->create([
            'first_name' => 'Keno',
            'last_name' => 'Aguiar',
            'username' => 'yellowboi',
            'email' => 'keno@mail.com',
        ]);

        $jeremy = User::factory()->create([
            'first_name' => 'Jeremy',
            'last_name' => 'Aguiar',
            'username' => 'jayremy',
            'email' => 'jeremy@mail.com',
        ]);

        $ryan = User::factory()->create([
            'first_name' => 'Ryan',
            'last_name' => 'Cortez',
            'username' => 'ryry',
            'email' => 'ryan@mail.com',
        ]);

        $kevin = User::factory()->create([
            'first_name' => 'Kevin',
            'last_name' => 'Bautista',
            'username' => 'kb',
            'email' => 'kevin@mail.com',
        ]);

        $augy = User::factory()->create([
            'first_name' => 'Augy',
            'last_name' => 'Lagundino',
            'username' => 'awgeeeee',
            'email' => 'augy@mail.com',
        ]);

        $game = Game::factory()->create([
            'game_name' => 'Machi Koro 2',
            'game_description' => 'A city building game',
            'game_image' => 'https://cf.geekdo-images.com/medium/img/8Z3Z5Z2Z5Z5Z5Z5Z5Z5Z5Z5Z5=/fit-in/500x500/filters:no_upscale():strip_icc()/pic2437871.jpg',
            'game_url' => 'https://boardgamegeek.com/boardgame/205583/machi-koro-bright-lights-big-city',
            'game_min_players' => 2,
            'game_max_players' => 5,
            'game_min_playtime' => 30,
            'game_max_playtime' => 45,
        ]);

        $gameResult = GameResult::factory()->create([
            'game_date' => '2021-09-18',
            'game_id' => $game->id,
        ]);

        $player1 = Player::factory()->create([
            'user_id' => $jc->id,
            'game_result_id' => $game->id,
            'rank' => 1,
        ]);

        $player2 = Player::factory()->create([
            'user_id' => $keno->id,
            'game_result_id' => $game->id,
            'rank' => 2,
        ]);

        $player3 = Player::factory()->create([
            'user_id' => $jeremy->id,
            'game_result_id' => $game->id,
            'rank' => 3,
        ]);
    }
}
