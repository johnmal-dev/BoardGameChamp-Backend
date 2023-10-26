<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //store new user
    public function index()
    {
        return User::query()->orderBy('username')->get();
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}
