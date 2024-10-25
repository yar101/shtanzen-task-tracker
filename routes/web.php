<?php

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

Route::get('tasks', [TaskController::class, 'index'])->middleware('auth')->name('tasks');
