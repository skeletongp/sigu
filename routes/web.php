<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (!Auth::user()) {
        return view('welcome');
    }
    return redirect()->back();
})->name('welcome');

//Rutas de usuarios
Route::resource('users', UserController::class)->middleware(['auth'])->names('users');
Route::get('/auth/login',[UserController::class,'log'])->name('users.log');
Route::post('/auth/login',[UserController::class,'login'])->name('users.login');
Route::get('/auth/logout',[UserController::class,'logout'])->name('users.logout');
Route::get('users/delete/{user}', [UserController::class,'delete'])->name('users.delete');




