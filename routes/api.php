<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
Route::resource('tasks', 'UserController');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', UserController::class);

Route::get('/game-results/{gameResult}', function (App\Models\GameResult $gameResult) {
    return $gameResult;
});
