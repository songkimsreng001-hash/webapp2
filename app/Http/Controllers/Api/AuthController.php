<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Standard email/password registration.
     * (Kept as-is from your existing project — shown here so googleLogin() below
     * can be compared against it. Delete this method if you already have it.)
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Fix from README: register now returns a token so Flutter can auto-login
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Standard email/password login.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Fix from README: delete old tokens before issuing a new one
        $user->tokens()->delete();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    /**
     * NEW: Google login / register.
     *
     * Flutter sends the Google ID token it got from the native google_sign_in
     * package. We verify it with Socialite, then find-or-create the user by
     * email, and return a Sanctum token in the exact same shape as login()
     * and register() above — so the Flutter side needs zero special-casing.
     */
    public function googleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->userFromToken($request->id_token);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Invalid Google token',
            ], 401);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            $user = User::create([
                'name'              => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                'email'             => $googleUser->getEmail(),
                'password'          => Hash::make(Str::random(32)), // unusable random password
                'google_id'         => $googleUser->getId(),
                'email_verified_at' => now(), // Google already verified this email
            ]);
        } elseif (empty($user->google_id)) {
            // Link an existing password-based account to this Google id
            $user->update(['google_id' => $googleUser->getId()]);
        }

        // Same token-rotation pattern as login()
        $user->tokens()->delete();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
