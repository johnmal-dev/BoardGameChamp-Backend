<?php

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get users
Route::get('/users', function () {
    return App\Models\User::query()->orderBy('username')->get();
});

// get all game results for a specific game, and users who played in that game
Route::get('/game-results/{gameResult}', function (App\Models\GameResult $gameResult) {
    return $gameResult;
});
