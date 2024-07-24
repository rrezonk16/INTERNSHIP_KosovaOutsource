<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->post('/posts', [PostController::class, 'store']);
Route::middleware('auth:api')->delete('/posts/{id}', [PostController::class, 'destroy']);
Route::middleware('auth:api')->put('/post/{id}', [PostController::class, 'update']); 

Route::middleware('auth:api')->post('/comment/{postId}', [CommentController::class, 'store']);
Route::middleware('auth:api')->delete('/comment/{id}', [CommentController::class, 'destroy']);
Route::middleware('auth:api')->put('/comment/{id}', [CommentController::class, 'update']); 
