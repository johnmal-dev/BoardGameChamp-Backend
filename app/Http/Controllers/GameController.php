<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): JsonResponse
    {
        $games = Game::query()->orderBy('game_name')->get();
        return response()->json($games);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $game = Game::query()->create([
                'game_name' => $request->input('game_name'),
                'game_description' => $request->input('game_description'),
                'game_image' => $request->input('game_image'),
                'game_url' => $request->input('game_url'),
                'game_min_players' => $request->input('game_min_players'),
                'game_max_players' => $request->input('game_max_players'),
                'game_min_playtime' => $request->input('game_min_playtime'),
                'game_max_playtime' => $request->input('game_max_playtime'),
            ]);
            return response()->json($game, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id): JsonResponse
    {
        if (!$gameFound = Game::query()->find($id)) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        return response()->json($gameFound);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        if (!$game = Game::query()->find($id)) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $game->fill($request->all());
        $game->save();

        return response()->json($game);
    }

    public function destroy(string $id): JsonResponse
    {
        if (!$game = Game::query()->find($id)) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $game->delete();
        return response()->json(['success' => 'Game deleted']);
    }
}
