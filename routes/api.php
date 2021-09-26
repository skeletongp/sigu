<?php

use App\Http\Controllers\Api\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('api/upload', [ApiController::class, 'uploadPhoto'])->name('api.upload');
Route::get('api/users',[UserController::class,'api_users'])->name('api.users');
Route::put('api/darkmode',[UserController::class,'darkmode'])->name('api.darkmode');