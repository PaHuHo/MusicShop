<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', [UserController::class,'index']);
Route::get('/user/search', [UserController::class,'search'])->name('search-user');
Route::post('/user/create', [UserController::class,'storeAdd'])->name('create-user');
Route::post('/user/edit/{id?}', [UserController::class,'storeEdit'])->name('edit-user');
Route::post('/user/delete/{id?}', [UserController::class,'storeDelete'])->name('delete-user');


Route::get('/product', [ProductController::class,'index']);
Route::get('/product/detail/{id}', [ProductController::class,'detail'])->name('get-detail-product');
Route::get('/product/search', [ProductController::class,'search'])->name('search-product');
Route::post('/product/create', [ProductController::class,'storeAdd'])->name('create-product');
Route::post('/product/edit/{id?}', [ProductController::class,'storeEdit'])->name('edit-product');
Route::post('/product/delete/{id?}', [ProductController::class,'storeDelete'])->name('delete-product');

Route::get('/category', [CategoryController::class,'index'])->name('get-list-category');
Route::get('/category/search', [CategoryController::class,'search'])->name('search-category');
Route::post('/category/create', [CategoryController::class,'storeAdd'])->name('create-category');


Route::post('/login', [AuthController::class,'loginCustomer']);

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logoutCustomer']);
    Route::get('/me', [AuthController::class, 'getCustomer']);
});


