<?php

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/game-results/{gameResult}', function (App\Models\GameResult $gameResult) {
//    return $gameResult;
//});
