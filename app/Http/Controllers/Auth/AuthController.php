<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:user,teacher,branch,adminbranch'
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => ucfirst($request->role) .
           ' registered successfully',
           'status' => 'success',
           'data' => $user,
        ],
            201);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:user,teacher,branch,adminbranch'
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Login gagal, username atau password salah.',
                'token' => null
            ], 401);
        }

        // Cek apakah role sesuai
        if ($user->role !== $request->role) {
            return response()->json([
                'status' => false,
                'message' => 'Login gagal, role tidak sesuai.',
                'token' => null
            ], 403);
        }

        // Buat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil.',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'role' => $user->role,
            ],
            'token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }
}
