<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Auth\AuthApiController;

/*
Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'delete']);
*/
Route::post('auth', [AuthApiController::class, 'authenticate']);

Route::group(['prefix' => 'v1'], function () {
    Route::get('categories/{id}/products', [CategoryController::class, 'products']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});

