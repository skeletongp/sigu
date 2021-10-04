<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SelectiondateController;
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

Route::get('/home',[HomeController::class, 'home'])->middleware(['auth'])->name('home');
Route::get('/', function () {
    if (!Auth::user()) {
        return view('welcome');
    }
    return redirect()->back();
})->name('welcome');

//Rutas de usuarios
Route::get('/auth/login', [UserController::class, 'log'])->name('users.log');
Route::post('/auth/login', [UserController::class, 'login'])->name('users.login');
Route::get('/auth/logout', [UserController::class, 'logout'])->name('users.logout');
Route::put('/select/{user}', [UserController::class, 'select'])->middleware(['auth'])->name('users.select');
Route::post('users/{slug}', [UserController::class, 'show'])->name('users.bytrim');
Route::resource('users', UserController::class)->middleware(['auth'])->names('users');
Route::delete('users/unselect/{subject}/{user}', [UserController::class, 'unselect'])->middleware(['auth'])->name('users.unselect');

/* Rutas de asignaturas */
Route::get('subjects/mysubjects', [SubjectController::class, 'mysubjects'])->middleware('auth')->name('subjects.mysubjects');
Route::delete('subjects/detach/{career}/{subject}', [SubjectController::class, 'detach'])->middleware(['auth'])->name('subjects.detach');
Route::get('subjects/myteachstudents/{subject}', [SubjectController::class, 'myteachstudents'])->middleware(['auth'])->name('subjects.myteachstudents');
Route::get('subjects/editnotes', [SubjectController::class, 'editnotes'])->middleware(['auth', 'role:teacher'])->name('subjects.editnotes');
Route::put('subjects/calificate', [SubjectController::class, 'calificate'])->middleware(['auth', 'role:teacher'])->name('subjects.calificate');
Route::resource('subjects', SubjectController::class)->middleware(['auth'])->names('subjects');

/* Rutas de secciones */
Route::get('sections/selection', [SectionController::class, 'selection'])->middleware(['auth'])->name('sections.selection');
Route::post('sections/select', [SectionController::class, 'select'])->middleware(['auth'])->name('sections.select');
Route::resource('sections', SectionController::class)->middleware(['auth', 'role:admin|support'])->names('sections');

/* Rutas de carreras */
Route::get('/careers/addsubject/{career}', [CareerController::class, 'addsubject'])->middleware(['auth'])->name('careers.addsubject');
Route::post('/careers/detachsubject/{career}/{subject}', [CareerController::class, 'detachsubject'])->middleware(['auth', 'role:admin|support'])->name('careers.detachsubject');
Route::post('/careers/storesubject/{career}', [CareerController::class, 'storesubject'])->middleware(['auth', 'role:admin|support'])->name('careers.storesubject');
Route::resource('careers', CareerController::class)->middleware(['auth'])->names('careers');

/* Fechas de selección */
Route::resource('selectiondates', SelectiondateController::class)->middleware(['auth', 'role:admin|support|teacher'])->names('selectiondates');
