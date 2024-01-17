<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\SessionPlayerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'users' => UserController::class,
    'games' => GameController::class,
    'game-sessions' => GameSessionController::class,
    'session-players' => SessionPlayerController::class,
]);

Route::post('/new-session', [GameSessionController::class, 'newSession']);
