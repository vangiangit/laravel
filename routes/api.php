<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth:api'])->group(function() {
    Route::prefix('product')->group(function() {
        Route::post('create', [\App\Http\Controllers\Api\ProductController::class, 'create'])->name('api-product-create');
    });

    Route::prefix('type')->group(function() {
        Route::get('/', [\App\Http\Controllers\Api\ProductTypeController::class, 'index'])->name('api-type-index');
        Route::post('create', [\App\Http\Controllers\Api\ProductTypeController::class, 'create'])->name('api-type-create');
    });

    Route::prefix('agency')->group(function() {
        Route::get('/', [\App\Http\Controllers\Api\ProductAgencyController::class, 'index'])->name('api-agency-index');
        Route::post('create', [\App\Http\Controllers\Api\ProductAgencyController::class, 'create'])->name('api-agency-create');
    });
});