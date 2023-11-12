<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::query()->orderBy('username')->get();
    }

    public function store(Request $request)
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

        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        return $user;
    }

    public function show($id)
    {
        $userFound = User::query()->find($id);
        if (!$userFound) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return $userFound;
    }

    public function update(Request $request, $id)
    {
        $user = User::query()->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->fill($request->all());
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = User::query()->find($id);

        if (!$user) {
            return null;
        }

        $user->delete();
        return response()->json(['success' => 'User deleted'], 200);
    }
}
