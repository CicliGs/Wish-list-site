<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::get('/wishes/create', [WishController::class, 'create'])->name('wishes.create');
    Route::post('/wishes', [WishController::class, 'store'])->name('wishes.store');
    Route::get('/wishes/{wish}/edit', [WishController::class, 'edit'])->name('wishes.edit');
    Route::put('/wishes/{wish}', [WishController::class, 'update'])->name('wishes.update');
    Route::delete('/wishes/{wish}', [WishController::class, 'destroy'])->name('wishes.destroy');

    Route::post('/wishes/{wish}/reserve', [ReservationController::class, 'reserve'])->name('wishes.reserve');
    Route::delete('/wishes/{wish}/unreserve', [ReservationController::class, 'unreserve'])->name('wishes.unreserve');
});

Route::get('/user/{userId}/wishes', [WishController::class, 'showUser'])->name('wishes.user');
