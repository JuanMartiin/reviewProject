<?php

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

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::resource('user', App\Http\Controllers\HomeController::class)->only(['index', 'edit', 'update', 'destroy']);

Route::resource('review', App\Http\Controllers\ReviewController::class);
Route::get('/', [App\Http\Controllers\ReviewController::class, 'index']);
Route::get('reviews/film', [App\Http\Controllers\ReviewController::class, 'films'])->name('films');
Route::get('reviews/record', [App\Http\Controllers\ReviewController::class, 'records'])->name('records');
Route::get('reviews/book', [App\Http\Controllers\ReviewController::class, 'books'])->name('books');