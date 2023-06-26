<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlgoritmaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;
 

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/soal-satu', [AlgoritmaController::class, 'soalSatu'])->name('satu');
Route::get('/soal-dua', [AlgoritmaController::class, 'soalDua'])->name('dua');
Route::get('/soal-tiga', [AlgoritmaController::class, 'soalTiga'])->name('tiga');

Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
Route::resource('rentals', RentalController::class);
