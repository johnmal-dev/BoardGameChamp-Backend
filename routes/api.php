<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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
