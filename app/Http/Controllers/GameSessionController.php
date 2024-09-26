<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use App\Models\SessionPlayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameSessionController extends Controller
{
    public function index(): JsonResponse
    {
        $gameSessions = GameSession::query()
            ->with([
                'sessionPlayers' => function ($query) {
                    $query
                        ->with('user:id,username')
                        ->get()
                        ->makeHidden(['game_id', 'game_session_id', 'created_at', 'updated_at']);
                },
                'game:id,game_name'
            ])
            ->orderBy('game_session_date', 'desc')
            ->get()
            ->makeHidden(['game_id', 'created_at', 'updated_at']);
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
            if (!$request->has(['session_players', 'game_session_date', 'game_id'])) {
                return response()->json(['error' => 'Missing info'], 400);
            }

            $gameSession = GameSession::query()->create([
                'game_session_date' => $request->input('game_session_date'),
                'game_id' => $request->input('game_id'),
            ])
                ->fresh()
                ->load('game');

            $sessionPlayers = $request->input('session_players');

            foreach ($sessionPlayers as $sessionPlayer) {
                SessionPlayer::query()->create([
                    'user_id' => $sessionPlayer['user_id'],
                    'game_session_id' => $gameSession->id,
                    'game_id' => $gameSession->game_id,
                    'ranking' => $sessionPlayer['ranking'],
                ])
                    ->fresh()
                    ->load(['user', 'gameSession']);
            }

            Log::info('New game session created', ['game_session_id' => $gameSession->id]);

            return response()->json($gameSession, 201);
    }
}
