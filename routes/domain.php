<?php

use App\Http\Controllers\DomainController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('domain', [DomainController::class, 'index'])->name('domain');
    Route::post('domains/check-price', [DomainController::class, 'checkDomainInfo'])->name('domains.check_price');
    Route::get('/domain/purchase', [DomainController::class, 'purchaseForm'])->name('domain.purchase.form');
    Route::post('/domain/purchase', [DomainController::class, 'purchaseDomain'])->name('domain.purchase');
});
