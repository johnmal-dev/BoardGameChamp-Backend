<?php

namespace App\Http\Controllers;

use App\Models\SessionPlayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionPlayerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        if (!$request->has(['game_session_id', 'user_id', 'game_id', 'ranking'])) {
            return response()->json(['error' => 'Game session ID, game ID, ranking and user ID are required'], 400);
        }

        $sessionPlayer = SessionPlayer::query()->create([
            'game_session_id' => $request->input('game_session_id'),
            'user_id' => $request->input('user_id'),
            'game_id' => $request->input('game_id'),
            'ranking' => $request->input('ranking'),
        ])
            ->fresh()
            ->load(['user', 'gameSession']);

        return response()->json($sessionPlayer, 201);
    }
}
