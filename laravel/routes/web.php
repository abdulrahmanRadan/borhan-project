<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorhanController;
use App\Http\Controllers\chatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    route::get('/borhan', [BorhanController::class, 'index'])->name('borhan.train');
    route::post('/borhan', [BorhanController::class, 'upload'])->name('borhan.train.upload');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat'); 
    Route::post('/chat', [ChatController::class, 'ask'])->name('chat.ask');
});

require __DIR__.'/auth.php';