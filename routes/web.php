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
    Route::post('create/position', 'createPosition')->middleware('auth')->name('create/position');
    Route::get('view/all/position', 'viewAllPosition')->middleware('auth')->name('view/all/position');
    Route::get('view/position/{id}', 'viewAPosition')->name('view/position');
    Route::get('/positions/{id}/edit', [PositionController::class, 'edit'])->name('edit/position');
    Route::put('update/position/{id}', 'updatePosition')->name('update/position');
    Route::delete('destroy/position/{id}', 'destroyPosition')->name('destroy/position');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
