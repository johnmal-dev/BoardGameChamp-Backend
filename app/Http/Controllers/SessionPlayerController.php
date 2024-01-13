<?php

namespace App\Http\Controllers;

use App\Models\SessionPlayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionPlayerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        if (!$request->has(['game_session_id', 'user_id', 'game_id'])) {
            return response()->json(['error' => 'Game session ID, game ID and user ID are required'], 400);
        }

        $sessionPlayer = SessionPlayer::query()->create([
            'game_session_id' => $request->input('game_session_id'),
            'user_id' => $request->input('user_id'),
            'game_id' => $request->input('game_id'),
        ])
            ->fresh()
            ->load(['user', 'gameSession']);

        return response()->json($sessionPlayer, 201);
    }
}
