<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'listUsers']);
Route::get('/filter', [UserController::class, 'filterUsers'])->name('filter');
