<?php

namespace App\Http\Controllers;

use App\Mail\NewClient;
use App\Models\AgencyWithClient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function register(Request $request, int $agency): JsonResponse
    {

        $agencyUser = User::where('cnpj', $agency)->first();

        if(!$agencyUser->id){
            return response()->json('Agência não encontrada');
        }
        if($agencyUser->type != 'agency'){
            return response()->json('Não é possível de fazer essa ação');
        }

        $client = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'client'
        ]);

        if ($client) {

            AgencyWithClient::create([
                'client' => $client->id,
                'agency' => $agencyUser->id
            ]);

            Mail::send(new NewClient($client, $agencyUser));

            $token = $client->createToken('Client');

            return response()->json([
                'status' => 'success',
                'message' => 'Agência criada com sucesso',
                'client' => $client,
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
