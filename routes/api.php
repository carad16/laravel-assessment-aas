<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('positions', [PositionController::class, 'createPosition']);
Route::get('positions', [PositionController::class, 'viewAllPosition']);
Route::get('positions/{id}', [PositionController::class, 'viewAPosition']);
Route::put('positions/{id}', [PositionController::class, 'updatePosition']);
Route::delete('positions/{id}', [PositionController::class, 'destroyPosition']);