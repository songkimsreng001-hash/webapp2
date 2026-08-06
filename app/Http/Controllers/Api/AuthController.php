<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User registered',
                'user' => $user,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function dashboard(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            return response()->json([
                'message' => 'Welcome to dashboard',
                'user' => $user,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Failed to load dashboard',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user || !$user->currentAccessToken()) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            $user->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully']);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}