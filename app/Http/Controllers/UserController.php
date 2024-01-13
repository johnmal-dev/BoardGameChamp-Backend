<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::query()->orderBy('username')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $missingInput = empty($request->input('username')) || empty($request->input('email')) || empty($request->input('password'));
        if ($missingInput) {
            return response()->json(['error' => 'Username, email and password are required'], 400);
        }

        $existingUsername = User::query()->where('username', $request->input('username'))->first();
        if ($existingUsername) {
            return response()->json(['error' => 'User already exists'], 400);
        }

        $existingEmail = User::query()->where('email', $request->input('email'))->first();
        if ($existingEmail) {
            return response()->json(['error' => 'Email already exists'], 400);
        }

        $user = User::query()->create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        return response()->json($user, 201);
    }

    public function show($id): JsonResponse
    {
        if (!$userFound = User::query()->find($id)) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($userFound);
    }

    public function update(Request $request, $id): JsonResponse
    {
        if (!$user = User::query()->find($id)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->fill($request->all())->save();

        return response()->json($user);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::query()->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['success' => 'User deleted']);
    }
}
