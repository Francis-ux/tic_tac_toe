<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index']);
Route::post('/move', [GameController::class, 'makeMove'])->name('move');
Route::post('/reset', [GameController::class, 'resetGame'])->name('reset');
