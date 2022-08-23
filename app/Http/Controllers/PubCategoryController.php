<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePubCategoryRequest;
use App\Http\Requests\UpdatePubCategoryRequest;
use App\Models\PubCategory;

class PubCategoryController extends Controller
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
     * @param  \App\Http\Requests\StorePubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePubCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PubCategory  $pubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PubCategory $pubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PubCategory  $pubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PubCategory $pubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePubCategoryRequest  $request
     * @param  \App\Models\PubCategory  $pubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePubCategoryRequest $request, PubCategory $pubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PubCategory  $pubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PubCategory $pubCategory)
    {
        //
    }
}
