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

Route::post('video', [\App\Http\Controllers\Admin\VideoController::class, 'ajax'])->name('video-crud');
Route::get('video/{id}', [\App\Http\Controllers\Admin\VideoController::class, 'apiShow'])->name('video-db-show');
// Route::post('video/{id}', [\App\Http\Controllers\Admin\VideoController::class, 'apiUpdate'])->name('video-db-update');
