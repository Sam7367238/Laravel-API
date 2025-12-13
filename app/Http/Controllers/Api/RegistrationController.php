<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function __invoke(Request $request) {
        $validated = $request -> validate([
            "name" => ["required", "min:3"],
            "email" => ["required", "email", "unique:users", "max:255"],
            "password" => ["required", Password::min(8)]
        ]);

        User::create($validated);

        return response() -> noContent();
    }
}
