<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
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
        Route::put('/{slug}/update', 'update')->name('update');
        Route::delete('/{slug}/delete', 'delete')->name('delete')->can('modify folder');
    });

    Route::controller(DocumentController::class)->name('documents.')->prefix('documents')->group(function () {
        Route::post('/store', 'store')->name('store');
        Route::get('/{doc}/edit', 'edit')->name('edit');
        Route::put('/{doc}/update', 'update')->name('update');
        Route::put('/{doc}/set-visibility', 'setVisibility')->name('set-visibility')->can('modify document');
        Route::delete('/{doc}/delete', 'delete')->name('delete')->can('modify document');
        Route::get('/{doc}/download', 'download')->name('download');
    });

    Route::controller(UsersController::class)->name('users.')
        ->prefix('users')->middleware('can:manage users')
        ->group(function ()
            {
                Route::get('/', 'index')->name('index');
                Route::post('/revoke-permission', 'revokePermission')->name('revoke-permission');
                Route::get('/give-permission', 'givePermission')->name('give-permission');
                Route::post('/grant-permission', 'grantPermission')->name('grant-permission');
            }
        );

});

require __DIR__.'/auth.php';
