<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('dashboard');

Route::name('auth.')->group(function() {
    Route::get('/login', [UserController::class, 'showLogin'])->name('login_page');

    Route::post('/login', [UserController::class, 'login'])->name('login');
    
    Route::get('/register', [UserController::class, 'showRegister'])->name('register_page');
    
    Route::post('/register', [UserController::class, 'register'])->name('register');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::name('schedules.')->group(function() {
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('index');

    Route::post('/schedules/create', [ScheduleController::class, 'create'])->name('create');

    Route::prefix('schedules/{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::get('/details', [ScheduleController::class, 'show'])->name('details');

        Route::post('/store-work-schedule', [ScheduleController::class, 'storeWorkSchedule'])->name('store_work_schedule');

        Route::put('/finish-work-schedule', [ScheduleController::class, 'finishWorkSchedule'])->name('finish_work_schedule');

        Route::get('/print-out', [ScheduleController::class, 'showPrintOut'])->name('print_out');
    });
});