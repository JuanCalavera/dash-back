<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\PubPiece\Comment;
use App\Models\PubPiece\PubPiece;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\PubRequest\PubRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\PubRequest\ReferenceFile;
use App\Models\PubRequest\ReferenceLink;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class PubPieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PubPiece::with('comment')
            ->latest()
            ->get()
            ->map(function ($pub) {
                $date = (new Carbon($pub->created_at))->toDateString();
                $date = explode('-', $date);
                $pub->created = $date[2] . '/' . $date[1] . '/' . $date[0];

                return $pub;
            });
    }

    public function indexRequest(Agency $agencyId): JsonResponse
    {
        if(!$agencyId){
            return response()->json(null);
        }

        $pubRequests = $agencyId->pubRequests()->orderBy('id', 'DESC')->get();
        return response()->json($pubRequests);
    }

    /**
     * Create a new request to the agency for pubPieces
     */
    public function makeRequest(Request $request): JsonResponse
    {

        $user = User::find(Auth::user()->id);
        $agency = $user->agency()->first();
        
        // dd('hello');
        $pubRequest = new PubRequest([
            'agency_id' => $agency->id,
            'user_id' => $user->id,
            'pub_type_id' => $request->pub_type_id,
            'pub_sub_type_id' => $request->pub_sub_type_id,
            'deliver_date' => $request->deliver_date,
            'size' => $request->size,
            'description' => $request->description,
            'exhibition_description' => $request->exhibition_description
        ]);


        return response()->json(['request' => $pubRequest]);
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, $this->getPubPieceCreationRules($request));

        $user = $request->user();

        try {
            $pubPiece = new PubPiece([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $pubPiece->pub_request_id = $request->pub_request_id;
            $pubPiece->agency_id =  $user->agency_id;
            $pubPiece->user_id = $user->id;

            if ($request->video_url) {
                $pubPiece->file_url = $request->video_url;
                $pubPiece->file_type = 'VIDEO';
            } else {
                $path = Storage::putFile('pubpieces/' . $user->id . '/', $request->file('file'));
                $pubPiece->file_url = $path;
                $pubPiece->file_type = $request->file('file')->getMimeType();
            }

            $pubPiece->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($pubPiece, 201);
    }

    private function getPubPieceCreationRules(Request $request): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pub_request_id' => 'nullable|integer|exists:id,pub_requests',
            'video_url' => ['string', 'nullable', Rule::requiredIf(!$request->hasFile('file'))],
            'file' => ['nullable', 'file', Rule::requiredIf(!$request->video_url)]
        ];
    }

    public function like(PubPiece $pub, Request $request): JsonResponse
    {
        $this->validate($request, [
            'comment' => 'required|string',
        ]);

        $pub = $this->execLike($pub, $request->comment, true);

        return response()->json($pub);
    }

    public function disLike(PubPiece $pub, Request $request): JsonResponse
    {
        $this->validate($request, [
            'comment' => 'required|string',
        ]);

        $pub = $this->execLike($pub, $request->comment, false);

        return response()->json($pub);
    }

    private function execLike(PubPiece $pub, string $commentText, bool $wasLiked): PubPiece
    {
        DB::beginTransaction();

        try {
            $this->createComment($pub, $commentText);

            $pub->was_liked = $wasLiked;
            $pub->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $pub->comment;

        return $pub;
    }

    private function createComment(PubPiece $pub, string $commentText): Comment
    {
        $comment = new Comment(['content' => $commentText]);
        $comment->pub_piece_id = $pub->id;
        $comment->save();

        return $comment;
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

    public function showAgency(Agency $agencyId): JsonResponse
    {
        return response()->json(['agency' => $agencyId, 'user' => Auth::user()->cnpj]);
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
