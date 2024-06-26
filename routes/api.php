<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(UserController::class)->group(function () {
    Route::patch('update', 'updateUser');
    Route::patch('password/change', 'updatePassword');
});


Route::controller(CartController::class)->group(function () {
    Route::get('cart/get', 'index');
    Route::post('cart/add', 'add');
    Route::patch('cart/update/{cart}', 'update');
    Route::delete('cart/remove/{cart}', 'remove');
});
