<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentBorrowController;
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

// student start
    // home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('home/show/{id}', [HomeController::class, 'show'])->name('home.user.show');
    Route::get('studentborrow', [StudentBorrowController::class, 'index'])->name('studentborrow.index');

    // booking
    Route::resource('booking', BookingController::class);
// student end

// admin start
    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('is_admin');

    // buku
    Route::resource('book', BookController::class)->middleware('is_admin');

    // category
    Route::resource('category', CategoryController::class)->middleware('is_admin');

    // borrow
    Route::get('borrow/{any}', [BorrowController::class, 'index'])->name('borrow.index')->middleware('is_admin');
    Route::post('borrow/', [BorrowController::class, 'store'])->name('borrow.store')->middleware('is_admin');
    Route::get('borrow/{id}/edit', [BorrowController::class, 'edit'])->name('borrow.edit')->middleware('is_admin');
    Route::put('borrow/{id}', [BorrowController::class, 'update'])->name('borrow.update')->middleware('is_admin');
    Route::delete('borrow/{id}/{any}', [BorrowController::class, 'destroy'])->name('borrow.destroy')->middleware('is_admin');

    // booking admin
    Route::resource('adminbooking', AdminBookingController::class)->middleware('is_admin');
    Route::get('adminbooking/create/{id}', [AdminBookingController::class, 'create'])->name('adminbooking.create')->middleware('is_admin');

    //user
    Route::middleware('is_admin')->group(function() {
        Route::get('user/{any}', [UserController::class, 'index'])->name('user.index');
        Route::get('user/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::delete('user/{id}/{any}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    });
// admin end

Auth::routes();
