<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('admin/login', [\App\Http\Controllers\Admin\UserController::class, 'login'])->name('admin-login');
Route::post('admin/login_store', [\App\Http\Controllers\Admin\UserController::class, 'loginStore'])->name('admin-login-store');
Route::get('admin/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout'])->name('admin-logout');

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('product')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin-product-list');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->where(['id' => '[0-9]+'])->name('admin-product-edit');
        Route::post('update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->where(['id' => '[0-9]+'])->name('admin-product-update');
    });

    Route::prefix('ajax')->group(function () {
        Route::post('uploadmultiimage/{config}', [\App\Http\Controllers\Admin\AjaxController::class, 'uploadMultiImage'])->name('admin-ajax-uploadmultiimage');
        Route::get('loadmultiimage/{config}', [\App\Http\Controllers\Admin\AjaxController::class, 'loadMultiImage'])->name('admin-ajax-loadmultiimage');
        Route::get('deletemultiimage/{config}', [\App\Http\Controllers\Admin\AjaxController::class, 'deleteMultiImage'])->name('admin-ajax-deletemultiimage');
    });
});
