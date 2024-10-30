<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tasks');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/register', [RegisteredController::class, 'create'])->name('register');
Route::post('/register', [RegisteredController::class, 'store']);

Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth')->name('tasks');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth')->name('task.store');
Route::get('/task/{id}', [TaskController::class, 'show'])->middleware('auth')->name('task');

Route::get('/contractors', [ContractorController::class, 'index'])->middleware('auth')->name('contractors');
Route::post('/contractors', [ContractorController::class, 'store'])->middleware('auth')->name('contractor.store');
Route::get('/contractor/{id}', [ContractorController::class, 'show'])->middleware('auth')->name('contractor');
