<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PositionController::class)->group(function () {
    Route::get('create/position', 'createPosition')->middleware('auth')->name('create/position');
    Route::get('view/all/position', 'viewAllPosition')->middleware('auth')->name('view/all/position');
    Route::post('view/position/{id}', 'viewAPosition')->name('view/position');
    Route::post('update/position/{id}', 'updatePosition')->name('update/position');
    Route::get('destroy/position/{id}', 'destroyPosition')->name('destroy/position');
});
