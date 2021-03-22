<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }
    // Artisan::call('mail:send', [
    //     'user' => $user, '--queue' => 'default'
    // ]);
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!Auth::attempt($loginData)) {

            return response(['message' => 'Invalid Credentials']);
        }

        $user = User::find(Auth::id());
        $accessToken= $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken],200);

    }
    public function logout()
    {
        Auth::logoutCurrentDevice();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function loggedInUser()
    {
        if (!Auth::check()) {
            return response()->json([
            'message' => 'User logged out'
        ]);
        }
        $user = Auth::user();

        return response(['user' => $user]);
    }
}