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

Route::post('register', [\App\Http\Controllers\Api\AuthenticationsController::class, 'register']);

Route::prefix('integration')->group(function(){
    Route::post('create', [\App\Http\Controllers\Api\IntegrationsController::class, 'create']);
    Route::put('{integration}', [\App\Http\Controllers\Api\IntegrationsController::class, 'update']);
    Route::delete('{integration}', [\App\Http\Controllers\Api\IntegrationsController::class, 'delete']);
});
