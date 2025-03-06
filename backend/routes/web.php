<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');;
Route::post('/login', [AuthController::class, 'storeLogin'])->name('store-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user', function () {
        return View('User/index');
    })->where('any', '.*')->name('user-page');

    Route::get('/', function () {
        return View('Product/index');
    })->where('any', '.*')->name('product-page');

    Route::get('/product/detail/{id}', function () {
        return View('Product/detail-product');
    })->where('any', '.*')->name('detail-product-page');

    Route::get('/category', function () {
        return View('category/index');
    })->where('any', '.*')->name('category-page');
});
