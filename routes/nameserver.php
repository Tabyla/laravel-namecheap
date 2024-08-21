<?php

use App\Http\Controllers\NameserverController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('nameserver', [NameserverController::class, 'index'])->name('nameserver.index');
    Route::post('nameserver', [NameserverController::class, 'store']);
    Route::put('nameserver', [NameserverController::class, 'update'])->name('nameserver.update');
    Route::get('nameserver/create', [NameserverController::class, 'create'])->name('nameserver.create');
    Route::get('nameserver/edit/{id}', [NameserverController::class, 'edit'])->name('nameserver.edit');
    Route::delete('/nameserver/{domain}/{nameserver}', [NameserverController::class, 'destroy']);
});
