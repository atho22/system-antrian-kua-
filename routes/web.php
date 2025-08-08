<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AdminController;

Route::get('/', [GuestController::class, 'create'])->name('guest.create');
Route::post('/guest', [GuestController::class, 'store'])->name('guest.store');
Route::get('/guest/{id}', [GuestController::class, 'show'])->name('guest.show');

Route::get('/antrian', [QueueController::class, 'index'])->name('queue.index');
Route::get('/riwayat', [QueueController::class, 'history'])->name('queue.history');
Route::get('/export', [QueueController::class, 'export'])->name('queue.export');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    Route::post('/queue/{id}/status', [AdminController::class, 'updateQueueStatus'])->name('admin.queue.status');
    Route::post('/queue/{id}/recall', [AdminController::class, 'recallQueue'])->name('admin.queue.recall');
});
