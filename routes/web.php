<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotteryController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    //Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Lottery Manage Routes
    Route::get('/lottery', [LotteryController::class, 'index'])->name('lottery');
    Route::post('/lottery', [LotteryController::class, 'store'])->name('saveLottery');
    Route::get('/lottery/delete/{id}', [LotteryController::class, 'delete'])->name('deleteLottery');
});

Route::post('/today-lottery', [HomeController::class,'todayLottery'])->middleware('web');
