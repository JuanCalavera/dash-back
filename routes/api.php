<?php

use App\Http\Controllers\Client\AgencyDataController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\PubPieceController;
use Illuminate\Http\Request;
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
    Route::post('pub-pieces/make-request', [PubPieceController::class, 'makeRequest']);

    Route::prefix('agency')->group(function () {
        Route::get('pub-request-data', [AgencyDataController::class, 'pubRequestData']);
    });
});
