<?php

namespace App\Http\Controllers;

use App\Mail\ClientCreation;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AgencyAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $agency = Auth::attempt([
            'cnpj' => $request->cnpj,
            'password' => $request->password
        ]);

        if ($agency) {
            $user = Auth::user();
            $token = $user->createToken('Agency');
            return response()->json([
                'status' => 'success',
                'agency' => $agency,
                'authorization' => [
                    $user->type,
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
            'type' => 'agency'
        ]);

        if ($agency) {
            $token = $agency->createToken('Agência');
            $agency = Auth::attempt([
                'cnpj' => $request->cnpj,
                'password' => $request->password
            ]);

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
        if ($agency->id) {
            $update = $agency->update([
                'name' => $request->name ? $request->name : $agency->name,
                'email' => $request->email ? $request->email : $agency->email,
            ]);

            if ($update) {
                return response()->json([$agency]);
            }

            return response()->json(['error' => 'Não foi possível atualizar o usuário'], 500);
        }

        return response()->json(['error' => 'Usuário não encontrado'], 500);
    }

    public function destroy(User $agency): JsonResponse
    {
        if ($agency->id) {
            $name = $agency->name;
            if ($agency->delete()) {
                return response()->json(["success" => "Excluído o usuário {$name}"]);
            }
            return response()->json(["error" => "Não foi possível excluir o usuário {$name}"], 401);
        }
        return response()->json(["error" => "Não foi possível identificar usuário"], 401);
    }

    public function createLinkForClient(Request $request): JsonResponse
    {
        if(!$request->email || !$request->name){
            return response()->json('Não há um campo inserido');   
        }
        if(!Auth::check()){
            return response()->json('Não foi possível criar uma url');
        }

        $userId = Auth::user()->id;
            $tempUrl = "https://laravel.com/docs/9.x/sanctum#main-content/?podman={$userId}";
            Mail::send(new ClientCreation($request->email, $request->name, Auth::user()->name));
            

            return response()->json("Criada a URL: {$tempUrl}");
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        if(!$request->email){
            return response()->json('Email faltante');
        }

        $user = User::where('email', $request->email)->first();

        if(!$user->id){
            return response()->json('Nenhum usuário com esse email');
        }

        $code = mt_rand(10000000, 99999999);

        $user->code = $code;
        $user->save();

        Mail::send(new ForgotPassword($user, $code));

        return response()->json('Código de recuperação enviado para o seu email');
    }

    public function refactPassword(Request $request): JsonResponse
    {
        if(!$request->password || !$request->repass || !$request->code){
            return response()->json('Há campos faltantes', 401);
        }

        if($request->password != $request->repass){
            return response()->json('As senhas não correspondem', 401);
        }

        $user = User::where('code', $request->code)->first();

        if(!$user->id){
            return response()->json('Código incorreto', 401);
        }

        $user->password = Hash::make($request->password);
        $user->code = null;
        $user->save();

        return response()->json('Código atualizado :)');
    }

    public function getUser(): JsonResponse
    {
        if(!Auth::check()){
            return response()->json('Autenticação inválida', 401);
        }

        return response()->json(Auth::user());
    }
}
