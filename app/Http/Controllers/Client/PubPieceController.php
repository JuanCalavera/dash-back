<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PubPiece\PubPiece;
use App\Models\PubRequest\PubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PubPieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PubPiece::with('comments')->latest()->get();
    }

    /**
     * Create a new request to the agency for pubPieces
     */
    public function makeRequest(Request $request)
    {
        $this->validate($request, $this->getRequestCreationRules());

        DB::beginTransaction();

        $user = $request->user();

        try {
            $pubRequest = new PubRequest([
                'exhibition_description' => $request->exhibition_description,
                'deliver_date' => $request->deliver_date,
                'size' => $request->size,
                'description' => $request->description
            ]);

            $pubRequest->theme_id = $request->theme_id;
            $pubRequest->draw_type_id = $request->draw_type_id;
            $pubRequest->agency_id =  $user->agency_id;
            $pubRequest->user_id = $user->id;

            $pubRequest->save();

            foreach ($request->budget_types_ids as $bId) $pubRequest->budgetTypes()->attach($bId);

            // trabalho com arquivos (a decidir ainda)
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json(['request' => $pubRequest], 201);
    }

    private function getRequestCreationRules(): array
    {
        return [
            'theme_id' => 'required|integer|exists:themes,id',
            'draw_type_id' => 'required|integer|exists:draw_types,id',
            'exhibition_description' => 'required|string',
            'deliver_date' => 'required|date|after:now',
            'size' => 'required|string|max:255',
            'budget_types_ids' => 'required',
            'budget_types_ids.*' => 'integer|exists:budget_types,id',
            'description' => 'string'
            // faltando validar arquivos (a decidir ainda)
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PubPiece\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function show(PubPiece $pubPiece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PubPiece\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PubPiece $pubPiece)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PubPiece\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function destroy(PubPiece $pubPiece)
    {
        //
    }
}
