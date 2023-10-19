<?php
use Illuminate\Http\Request;
Route::resource('tasks', 'UserController');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get users
Route::get('/users', function () {
    return App\Models\User::query()->orderBy('username')->get();
});

// create new user
Route::post('/users', function (Request $request) {
    $user = new App\Models\User;
    $user->username = $request->input('username');
    $user->email = $request->input( 'email');
    $user->password = $request->input('password');
    $user->save();
    return $user;
});

// add first_name and last_name to user with id of 8
Route::patch('/users/{id}', function (Request $request, $id) {
    $user = (new App\Models\User)->find($id);
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->save();
    return $user;
});

// delete user with id of 8
Route::delete('/users/{id}', function ($id) {
    $user = (new App\Models\User)->find($id);
    $user->delete();
    return $user;
});

// get all game results for a specific game, and users who played in that game
Route::get('/game-results/{gameResult}', function (App\Models\GameResult $gameResult) {
    return $gameResult;
});
