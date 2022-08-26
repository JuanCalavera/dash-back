<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $agency = Auth::attempt([
            'cnpj' => $request->cnpj,
            'password' => $request->password
        ]);

        if ($agency) {
            $user = Auth::user();
            $token = $user->createToken('Client');
            return response()->json([
                'status' => 'success',
                'agency' => $agency,
                'authorization' => [
                    $token->accessToken->name,
                    $token->plainTextToken
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Usuário Inválido'
        ], 401);
    }

    public function register(Request $request): JsonResponse
    {

        $agency = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
            'password' => Hash::make($request->password),
            'type' => 'client'
        ]);

        if ($agency) {
            $token = $agency->createToken('Client');

            return response()->json([
                'status' => 'success',
                'message' => 'Agência criada com sucesso',
                'agency' => $agency,
                'authorization' => [
                    $token->accessToken->name,
                    $token->plainTextToken
                ]
            ]);
        }

        return response()->json(['error' => 'Erro ao criar usuário']);
    }

    public function update(User $agency, Request $request): JsonResponse
    {
        $update = $agency->update([
            'name' => $request->name ? $request->name : $agency->name,
            'email' => $request->email ? $request->email : $agency->email,
        ]);

        if ($update) {
            return response()->json([$agency]);
        }

        return response()->json(['error' => 'Não foi possível atualizar o usuário']);
    }

    public function destroy(User $agency): JsonResponse
    {
        if ($agency) {
            $name = $agency->name;
            if ($agency->delete()) {
                return response()->json(["success" => "Excluído o usuário {$name}"]);
            }
            return response()->json(["error" => "Não foi possível excluir o usuário {$name}"], 401);
        }
        return response()->json(["error" => "Não foi possível identificar usuário"], 401);
    }
}
