<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'cnpj' => 'required|cnpj',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'cnpj' => $request->cnpj,
            'password' => $request->password
        ]))
            return response()->json(['error' => 'Invalid Login Credentials'], 401);


        $user = User::where('cnpj', $request->cnpj)->with(['pubPieces'])->first();

        $token = $user->createToken($request->cnpj)->plainTextToken;

        return response()->json(['token' => $token, 'token_type' => 'Bearer', 'user' => $user], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([], 204);
    }
}
