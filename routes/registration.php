<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('reg', [RegistrationController::class, 'index'])->name('reg');
Route::post('reg', [RegistrationController::class, 'register']);
