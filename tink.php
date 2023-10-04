<?php

use App\Models\Game;
use App\Models\GameSession;
use App\Models\SessionPlayer;
use App\Models\SessionRanking;
use App\Models\User;

$user = User::factory()->create();
$game = Game::factory()->create();
$gameSession = GameSession::factory()->create([
    'game_id' => $game->id,
]);
$sessionPlayer = SessionPlayer::factory()->create([
    'user_id' => $user->id,
    'game_id' => $game->id,
    'game_session_id' => $gameSession->id,
]);
$sessionRanking = SessionRanking::factory()->create([
    'session_player_id' => $sessionPlayer->id,
    'game_id' => $game->id,
]);
