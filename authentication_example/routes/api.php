<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;

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


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user', function(Request $request) {
        return $request->user();
    });

    Route::middleware('role:admin')->group(function() {
        // Admin ONLY
    });
});


Route::middleware('auth:api')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); 
});


Route::middleware('auth:api')->group(function () {
    Route::post('/posts/{postId}/threads', [ThreadController::class, 'store']);
    Route::delete('/threads/{id}', [ThreadController::class, 'destroy']); 
});
Route::middleware('auth:api')->get('show-role', [UserController::class, 'showRole']);
