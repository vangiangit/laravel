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

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});