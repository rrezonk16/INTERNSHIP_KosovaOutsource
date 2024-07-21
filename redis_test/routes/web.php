<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\RedisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Redis', [RedisController::class,'index' ]);
Route::get('/api-limiter', [ApiController::class,'handleRequest' ]);

Route::post('/track-page-view/{page}', [AnalyticsController::class, 'trackPageView']);
Route::get('/get-page-views/{page}', [AnalyticsController::class, 'getPageViews']);
