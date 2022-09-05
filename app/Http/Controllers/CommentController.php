<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\PubPiece;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PubPiece $pubPiece)
    {
        $comments = Comment::where('pubpiece_id', $pubPiece->id)->get();

        if ($comments) {
            return response()->json($comments);
        }

        return response()->json(['warning' => 'Nenhum comentário encontrado']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PubPiece $pubPiece, Request $request)
    {
        $comment = Comment::create([
            'content' => $request->content,
            'pubpiece_id' => $pubPiece->id
        ]);

        if ($comment) {
            return response()->json($comment);
        }

        return response()->json(['error' => "Erro ao gerar comentário"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    /* public function show(Comment $comment)
    {
        if ($comment) {
            return response()->json($comment);
        }

        return response()->json(['error' => 'Comentário não localizado']);
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->id) {
            $comment->update([
                'content' => $request->content,
            ]);

            return response()->json($comment);
        }

        return response()->json(['error' => 'Comentário não localizado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->id) {
            if ($comment->delete()) {
                return response()->json(["success" => 'Comentário removido']);
            }
            return response()->json(["error" => 'Erro ao deletar o comentário'], 417);
        }
        return response()->json(["error" => 'Comentário não localizado'], 404);
    }
}
