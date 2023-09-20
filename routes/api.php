<?php

use App\Models\PlayResult;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get users
Route::get('/users', function () {
    return App\Models\User::query()->orderBy('username')->get();
});

// get all game results with players, exclude id and timestamps
Route::get('/play-results', function () {
    return App\Models\PlayResult::with('players')->get();
});

// get all game results for a specific game
Route::get('/play-results/{game_id}', function ($game_id) {
    return DB::table('play_results')
        ->join('players', 'play_results.id', '=', 'players.play_result_id')
        ->join('users', 'players.user_id', '=', 'users.id')
        ->get();
});
