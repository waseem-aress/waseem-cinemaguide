<?php

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


// Public Routes
Route::post("/register",[App\Http\Controllers\API\FrontAPIController::class, 'register']);

// Protected Routes
// Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('movies', [App\Http\Controllers\API\FrontAPIController::class, 'movies']);
        Route::get('cinemas', [App\Http\Controllers\API\FrontAPIController::class, 'cinemas']);
        Route::get('cinema/{name}', [App\Http\Controllers\API\FrontAPIController::class, 'cinema_details']);
        Route::get('movie/{title}', [App\Http\Controllers\API\FrontAPIController::class, 'movie_details']);
    });
// });
