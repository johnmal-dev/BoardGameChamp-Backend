<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return Game::query()->orderBy('game_name')->get();
    }

    public function store(Request $request)
    {
        $game = new Game;
        $game->game_name = $request->input('game_name');
        $game->game_description = $request->input('game_description');
        $game->game_image = $request->input('game_image');
        $game->game_url = $request->input('game_url');
        $game->game_min_players = $request->input('game_min_players');
        $game->game_max_players = $request->input('game_max_players');
        $game->game_min_playtime = $request->input('game_min_playtime');
        $game->game_max_playtime = $request->input('game_max_playtime');
        $game->save();
        return $game;
    }

    public function show(string $id)
    {
        $gameFound = Game::query()->find($id);
        if (!$gameFound) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        return $gameFound;
    }

    public function update(Request $request, string $id)
    {
        $game = Game::query()->find($id);
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $game->fill($request->all());
        $game->save();

        return $game;
    }

    public function destroy(string $id)
    {
        $game = Game::query()->find($id);
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $game->delete();
        return response()->json(['success' => 'Game deleted'], 200);
    }
}
