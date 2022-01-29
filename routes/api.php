<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/postList',[\App\Http\Controllers\PostController::class,'postList'])->name('post.list');
Route::post('/destroyPost/{post}',[\App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');
Route::post('/storePost',[\App\Http\Controllers\PostController::class,'store'])->name('post.store');
Route::post('/updatePost/{post}',[\App\Http\Controllers\PostController::class,'update'])->name('post.update');
