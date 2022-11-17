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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\LogBookController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/', [App\Http\Controllers\::class, 'index'])->name('index')->middleware('auth');
Route::post('/log-book', [App\Http\Controllers\LogBookController::class, 'store'])->name('log-book.store')->middleware('auth');


