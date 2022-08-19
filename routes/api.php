<?php

use App\Http\Controllers\Client\AgencyDataController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\PubPieceController;
use App\Http\Controllers\UserController;
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

Route::post('login', [ClientAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('pub-pieces', PubPieceController::class)->only('index', 'store');
    Route::get('pub-pieces/{agencyId}', [PubPieceController::class, 'indexRequest']);
    Route::post('pub-pieces/make-request', [PubPieceController::class, 'makeRequest']);
    Route::post('pub-pieces/{pub}/like', [PubPieceController::class, 'like']);
    Route::post('pub-pieces/{pub}/dislike', [PubPieceController::class, 'dislike']);

    Route::prefix('agency')->middleware('auth:sanctum')->group(function () {
        Route::get('pub-request-data', [AgencyDataController::class, 'pubRequestData']);
        Route::get('/{agencyId}', [PubPieceController::class, 'showAgency']);
    });
});
