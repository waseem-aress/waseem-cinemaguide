<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CinemasController;
use App\Http\Controllers\SessionController;

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


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\CinemasController::class, 'index'])->name('cinema');
Route::resource('cinemas', CinemasController::class);
Route::resource('cinemas/session_time',SessionController::class);
Route::resource('movies', MoviesController::class);
Route::get('cinemas/session_time/create/{cinema_id}', [App\Http\Controllers\SessionController::class, 'create'])->name('session_time.create');
Route::get('cinemas/session_time/edit/{session_id}/{cinema_id}', [App\Http\Controllers\SessionController::class, 'edit'])->name('session_time.edit');
});

