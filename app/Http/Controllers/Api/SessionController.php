<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (! Auth::attempt($validated)) {
            throw ValidationException::withMessages(['email' => 'Credentials do not match.']);
        }

        $user = $request->user();
        $token = $user->createToken('main')->plainTextToken;

        /*
        return response() -> json([
            new UserResource($user),
            "token" => $token
        ], 201);
        */

        return [
            'user' => new UserResource($user),
            'token' => $token,
        ];
    }
}
