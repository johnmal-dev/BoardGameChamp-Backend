<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameSession;
use App\Models\SessionPlayer;
use App\Models\SessionRanking;
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

        $gameSession = GameSession::factory()->create([
            'game_date' => '2021-10-04',
            'game_id' => $game->id,
        ]);

        $sessionPlayer1 = SessionPlayer::factory()->create([
            'user_id' => $jc->id,
            'game_id' => $game->id,
            'game_session_id' => $gameSession->id,
        ]);

        $sessionRankPlayer1 = SessionRanking::factory()->create([
            'session_player_id' => $sessionPlayer1->id,
            'game_id' => $game->id,
            'session_rank' => 1,
        ]);

        $sessionPlayer2 = SessionPlayer::factory()->create([
            'user_id' => $keno->id,
            'game_id' => $game->id,
            'game_session_id' => $gameSession->id,
        ]);

        $sessionRankPlayer2 = SessionRanking::factory()->create([
            'session_player_id' => $sessionPlayer2->id,
            'game_id' => $game->id,
            'session_rank' => 2,
        ]);

        $sessionPlayer3 = SessionPlayer::factory()->create([
            'user_id' => $jeremy->id,
            'game_id' => $game->id,
            'game_session_id' => $gameSession->id,
        ]);

        $sessionRankPlayer3 = SessionRanking::factory()->create([
            'session_player_id' => $sessionPlayer3->id,
            'game_id' => $game->id,
            'session_rank' => 3,
        ]);
    }
}
