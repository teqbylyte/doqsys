<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(FolderController::class)->name('folders.')->prefix('folders')->group(function () {
        Route::post('/store', 'store')->name('store');
        Route::get('/{slug}', 'show')->name('show');
        Route::post('/{slug}/update', 'update')->name('update');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->middleware('can:delete folder');
    });

});

require __DIR__.'/auth.php';
