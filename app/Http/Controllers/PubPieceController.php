<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePubPieceRequest;
use App\Http\Requests\UpdatePubPieceRequest;
use App\Models\PubPiece;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PubPieceController extends Controller
{

    public function index(): JsonResponse
    {
        $pubs = PubPiece::all();
        return response()->json(['pubs' => $pubs]);
    }

    public function store(Request $request): JsonResponse
    {
        $pub = PubPiece::create([
            'status' => 'pending',
            'title' => $request->title,
            'description' => $request->description,
            'deliver_date' => $request->deliver_date,
            'user_id' => Auth::user()->id
        ]);


        if ($pub) {
            return response()->json($pub);
        }

        return response()->json(['error' => "Deu erro ao criar publicidade"]);
    }

    public function show(PubPiece $pubPiece): JsonResponse
    {
        return response()->json($pubPiece);
    }

    public function update(Request $request, PubPiece $pubPiece): JsonResponse
    {
        if ($pubPiece->update([
            'title' => $request->title ? $request->title : $pubPiece->title,
            'description' => $request->description ? $request->description : $pubPiece->description,
            'deliver_date' => $request->deliver_date ? $request->deliver_date : $pubPiece->deliver_date,
        ])) {
            return response()->json($pubPiece);
        }

        return response()->json(['error' => 'Não foi possível atualizar usuário']);
    }

    public function updateStatus(Request $request, PubPiece $pubPiece): JsonResponse
    {
        if ($pubPiece->id) {
            if ($pubPiece->update([
                'status' => $request->status ? $request->status : $pubPiece->status,
            ])) {
                return response()->json(["status" => $pubPiece->status]);
            }
            return response()->json(['error' => "Publicidade não atualizada"], 500);
        }

        return response()->json(['error' => "Publicidade não localizada"], 500);
    }

    public function destroy(PubPiece $pubPiece): JsonResponse
    {
        if ($pubPiece->id) {
            $title = $pubPiece->title;
            if ($pubPiece->delete()) {
                return response()->json(['success' => "Deletada a publicidade {$title}"]);
            }
            return response()->json(['error' => "Não foi possível deletar a publicidade {$title}"]);
        }
        return response()->json(['error' => 'A publicidade não foi encontrada']);
    }
}
