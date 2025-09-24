<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LotteryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/lottery', [LotteryController::class, 'index'])->name('lottery.index');
    Route::post('/lottery', [LotteryController::class, 'store'])->name('lottery.store');
});

