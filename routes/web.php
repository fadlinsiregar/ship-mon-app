<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [UserController::class, 'index'])->name('dashboard')->middleware('user');

Route::name('auth.')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::name('schedules.')->prefix('schedules')->group(function() {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');

    Route::post('/', [ScheduleController::class, 'create'])->name('create');

    Route::prefix('/{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::get('/details', [ScheduleController::class, 'show'])->name('details');

        Route::post('/store', [ScheduleController::class, 'storeWorkSchedule'])->name('store_work_schedule');

        Route::put('/finish', [ScheduleController::class, 'finishWorkSchedule'])->name('finish_work_schedule');

        Route::get('/workers', [ScheduleController::class, 'getWorkers'])->name('workers');

        Route::post('/workers', [ScheduleController::class, 'storeUser'])->name('store_worker');

        Route::post('/workers/add-user', [ScheduleController::class, 'addUserToWorkers'])->name('add_user_to_workers');
    });
});
