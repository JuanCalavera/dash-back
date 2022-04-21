<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencySettings\PubType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AgencyDataController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function pubRequestData(Request $request): JsonResponse
  {
    $user = $request->user();
    $agency = Agency::with([
      'budgetTypes'
    ])->where('id', $user->agency_id)->first();

    $pubTypes = PubType::with('subTypes')->where('agency_id', $agency->id)->get();

    return response()->json([
      'pubTypes' => $pubTypes,
      'budgetTypes' => $agency->budgetTypes,
    ]);
  }

  // /**
  //  * Display the specified resource.
  //  *
  //  * @param  \App\Models\PubPiece\PubPiece  $pubPiece
  //  * @return \Illuminate\Http\Response
  //  */
  // public function show(PubPiece $pubPiece)
  // {
  //   //
  // }

  // /**
  //  * Update the specified resource in storage.
  //  *
  //  * @param  \Illuminate\Http\Request  $request
  //  * @param  \App\Models\PubPiece\PubPiece  $pubPiece
  //  * @return \Illuminate\Http\Response
  //  */
  // public function update(Request $request, PubPiece $pubPiece)
  // {
  //   //
  // }

  // /**
  //  * Remove the specified resource from storage.
  //  *
  //  * @param  \App\Models\PubPiece\PubPiece  $pubPiece
  //  * @return \Illuminate\Http\Response
  //  */
  // public function destroy(PubPiece $pubPiece)
  // {
  //   //
  // }
}
