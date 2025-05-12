<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Login an existing user.
     *
     * @param array $credentials
     * @return array|bool
     */
    public function login(array $credentials)
    {
        // Find the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return false; // Return false for invalid credentials
        }

        // Generate a Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Logout the authenticated user.
     *
     * @return void
     */
    public function logout($request)
    {
        // Auth::user()->tokens()->delete();
        $request->user()->tokens()->delete();
    }
}
