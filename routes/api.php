<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\UserController;

Route::resources([
    'users' => UserController::class,
    'games' => GameController::class,
    'game-sessions' => GameSessionController::class,
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/game-results/{gameResult}', function (App\Models\GameResult $gameResult) {
//    return $gameResult;
//});
