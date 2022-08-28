<?php

use App\Http\Controllers\AgencyAuthController;
use App\Http\Controllers\Client\PubPieceController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\CommentController;
use App\Mail\ClientCreation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/agency')->group(function () {
    Route::post('/login', [AgencyAuthController::class, 'login']);
    Route::post('/register', [AgencyAuthController::class, 'register']);
    Route::post('/update/{agency}', [AgencyAuthController::class, 'update']);
    Route::get('/delete/{agency}', [AgencyAuthController::class, 'destroy']);
});

Route::prefix('/agency')->middleware('auth:sanctum')->group(function () {
    Route::post('/create-link', [AgencyAuthController::class, 'createLinkForClient']);
});

Route::get('/create-link', function(){
    return new ClientCreation("juanconecti@gmail.com", 'Juan');
    // Mail::send(new ClientCreation('juanconecti@gmail.com'));
});

Route::prefix('/client')->group(function () {
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::post('/register', [ClientAuthController::class, 'register']);
    Route::post('/update/{client}', [ClientAuthController::class, 'update']);
    Route::get('/delete/{client}', [ClientAuthController::class, 'destroy']);
});

Route::prefix('/pub-piece')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [PubPieceController::class, 'index']);
    Route::post('/', [PubPieceController::class, 'store']);
    Route::get('/{pubPiece}', [PubPieceController::class, 'show']);
    Route::post('/update/{pubPiece}', [PubPieceController::class, 'update']);
    Route::get('/delete/{pubPiece}', [PubPieceController::class, 'destroy']);
    Route::get('{pubPiece}/comment', [CommentController::class, 'index']);
    Route::post('{pubPiece}/comment', [CommentController::class, 'store']);
    Route::get('/{pubPiece}/comment/{comment}', [CommentController::class, 'show']);
    Route::post('/{pubPiece}/comment/{comment}', [CommentController::class, 'update']);
    Route::get('/{pubPiece}/{comment}', [CommentController::class, 'destroy']);
});
