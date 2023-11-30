<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    public function index()
    {
        return GameSession::query()->orderBy('game_date', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return GameSession::create([
            'game_date' => $request->input('game_date'),
            'game_id' => $request->input('game_id'),
        ])
            ->fresh()
            ->load('game');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
