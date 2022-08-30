<?php

use App\Http\Controllers\DocumentController;
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
        Route::delete('/{slug}/delete', 'delete')->name('delete');
    });

    Route::controller(DocumentController::class)->name('documents.')->prefix('documents')->group(function () {
        Route::post('/store', 'store')->name('store');
        Route::get('/{doc}/edit', 'edit')->name('edit');
        Route::post('/{doc}/update', 'update')->name('update');
        Route::delete('/{doc}/delete', 'delete')->name('delete')->middleware('can:delete doc,delete folder');
        Route::get('/{doc}/download', 'download')->name('download');
    });


});

require __DIR__.'/auth.php';
