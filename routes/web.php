<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// admin start
    // dashboard
    Route::get('/dashboard', function () {
        return view('pages.admin.index');
    })->name('dashboard')->middleware('is_admin');

    // buku
    Route::get('/book', [BookController::class, 'index'])->name('book')->middleware('is_admin');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category')->middleware('is_admin');
// admin end

Auth::routes();
