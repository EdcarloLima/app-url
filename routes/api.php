<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,WebAddressController};

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

Route::post('login',    [AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('web-addresses')->group(function() {
    Route::get('/',        [WebAddressController::class, 'index']);
    Route::post('/',       [WebAddressController::class, 'store']);
    Route::get('/{id}',    [WebAddressController::class, 'show']);
    Route::put('/{id}',    [WebAddressController::class, 'update']);
    Route::delete('/{id}', [WebAddressController::class, 'destroy']);
});
