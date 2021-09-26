<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SubjectController;
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
Route::resource('careers', CareerController::class)->middleware(['auth', 'role:admin|support'])->names('careers');
Route::resource('subjects', SubjectController::class)->middleware(['auth', 'role:admin|support'])->names('subjects');
Route::get('/auth/login',[UserController::class,'log'])->name('users.log');
Route::post('/auth/login',[UserController::class,'login'])->name('users.login');
Route::get('/auth/logout',[UserController::class,'logout'])->name('users.logout');
Route::put('/select/{user}',[UserController::class,'select'])->name('users.select');

Route::delete('users/unselect/{subject}/{user}',[UserController::class,'unselect'])->name('users.unselect');
Route::delete('subjects/detach/{career}/{subject}',[SubjectController::class,'detach'])->name('subjects.detach');




