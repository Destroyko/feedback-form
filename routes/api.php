<?php

use App\Http\Controllers\API\V1\CountriesController;
use App\Http\Controllers\API\V1\FeedbackController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => '/v1',
], function () {
    Route::group([
        'prefix' => 'feedback'
    ], function () {
        Route::post('/create', [FeedbackController::class, 'create']);
    });

    Route::get('/countries', [CountriesController::class, 'show']);
});
