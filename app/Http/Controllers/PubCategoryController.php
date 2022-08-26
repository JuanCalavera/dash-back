<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePubCategoryRequest;
use App\Http\Requests\UpdatePubCategoryRequest;
use App\Models\PubCategory;
use Illuminate\Http\JsonResponse;

class PubCategoryController extends Controller
{

    public function index(): JsonResponse
    {
        $categories = PubCategory::all();

        if($categories){
            return response()->json($categories);
        }

        return response()->json(['error' => 'Não foi possível acessar as categorias'], 500);
    }

    public function store(StorePubCategoryRequest $request): JsonResponse
    {
        $category = PubCategory::create([
            'title' => $request->title
        ]);

        if($category){
            return response()->json($category);
        }

        return response()->json(['error' => "Não foi possível criar a categoria"], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PubCategory  $pubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PubCategory $pubCategory): JsonResponse
    {
        if($pubCategory){
            return response()->json($pubCategory);
        }

        return response()->json(['error' => 'Categoria não encontrada'], 500);
    }

    public function update(UpdatePubCategoryRequest $request, PubCategory $pubCategory): JsonResponse
    {
        if($pubCategory->id){
            $pubCategory->update([
                'title' => $request->title ? $request->title : $pubCategory->title
            ]);

            return response()->json($pubCategory);
        }

        return response()->json(['error' => 'Categoria não encontrada'], 500);
    }

    public function destroy(PubCategory $pubCategory): JsonResponse
    {
        if($pubCategory->id){

            $title = $pubCategory->title;

            if($pubCategory->delete()){
                return response()->json(['success' => "Categoria {$title} excluída com sucesso"]);
            }
        }

        return response()->json(['error' => 'Categoria não encontrada'], 500);
    }
}
