<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePubPieceRequest;
use App\Http\Requests\UpdatePubPieceRequest;
use App\Models\PubPiece;

class PubPieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePubPieceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePubPieceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function show(PubPiece $pubPiece)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function edit(PubPiece $pubPiece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePubPieceRequest  $request
     * @param  \App\Models\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePubPieceRequest $request, PubPiece $pubPiece)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PubPiece  $pubPiece
     * @return \Illuminate\Http\Response
     */
    public function destroy(PubPiece $pubPiece)
    {
        //
    }
}
