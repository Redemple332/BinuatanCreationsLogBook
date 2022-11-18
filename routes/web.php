<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\TourguideDriverController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/', [LogBookController::class, 'index'])->name('index');
    Route::post('/log-book', [LogBookController::class, 'store'])->name('log-book.store');
    Route::get('/agency', [AgencyController::class, 'index'])->name('agency.index');

    Route::group(['prefix'=>'tourguide-driver','as'=>'tourguide-driver.'], function(){
        Route::get('/', [TourguideDriverController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [TourguideDriverController::class, 'edit'])->name('edit');
        Route::get('/{id}/show', [TourguideDriverController::class, 'show'])->name('show');
        Route::put('/{id}', [TourguideDriverController::class, 'update'])->name('update');
        Route::get('/pdf', [TourguideDriverController::class, 'pdf'])->name('pdf');
    });
});
