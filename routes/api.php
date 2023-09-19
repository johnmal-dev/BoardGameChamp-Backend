<?php

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get users
Route::get('/users', function () {
    return App\Models\User::all();
});

// get all game results with players, exclude id and timestamps
Route::get('/game-results', function () {
    return App\Models\GameResult::with(['players', 'game'])->get()->makeHidden(['id', 'created_at', 'updated_at']);
});
