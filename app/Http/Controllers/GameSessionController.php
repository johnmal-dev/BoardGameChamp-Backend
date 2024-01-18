<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    public function index(): JsonResponse
    {
        $gameSessions = GameSession::query()->with('sessionPlayers')->orderBy('game_session_date', 'desc')->get();
        return response()->json($gameSessions);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            if (!$request->has(['game_id', 'game_session_date'])) {
                return response()->json(['error' => 'Game ID and game date are required'], 400);
            }

            $gameSession = GameSession::query()->create([
                'game_session_date' => $request->input('game_session_date'),
                'game_id' => $request->input('game_id'),
            ])
                ->fresh()
                ->load('game');

            return response()->json($gameSession, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id): JsonResponse
    {
        if (GameSession::query()->where('id', $id)->doesntExist()) {
            return response()->json(['error' => 'Game session not found'], 404);
        }

        $gameSession = GameSession::query()->with('game')->find($id);

        return response()->json($gameSession);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $gameSession = GameSession::query()->find($id);

        $gameSession->update([
            'game_session_date' => $request->input('game_session_date'),
            'game_id' => $request->input('game_id'),
        ]);

        $gameSession->load('game');

        return response()->json($gameSession);
    }

    public function destroy(string $id): JsonResponse
    {
        GameSession::query()->find($id)->delete();

        return response()->json(null, 204);
    }

    public function newGameSession(Request $request): JsonResponse
    {
        try {
            if (!$request->has(['session_player_ids', 'game_session_date'])) {
                return response()->json(['error' => 'Missing info'], 400);
            }

            $gameSession = GameSession::query()->create([
                'game_session_date' => $request->input('game_session_date'),
                'game_id' => $request->input('game_id'),
            ])
                ->fresh()
                ->load('game');

            return response()->json($gameSession, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
