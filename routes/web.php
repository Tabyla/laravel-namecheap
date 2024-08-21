<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\SiteController;
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


Route::domain(env('ADMIN_DOMAIN', 'backend.' . env('DOMAIN', false)))
    ->group(function () {
        Route::middleware('can:use-crud')->group(function () {
            Route::resource('/user', UserController::class);
        });
        require __DIR__ . '/auth.php';
        require __DIR__ . '/admin.php';
    });
Route::middleware(['auth'])->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('/');
    Route::get('/dashboard', [SiteController::class, 'index'])->name('dashboard');
    Route::post('/change-password', [SiteController::class, 'changePassword'])
        ->name('profile.change-password');
});
require __DIR__ . '/auth.php';
require __DIR__ . '/registration.php';
require __DIR__ . '/domain.php';
require __DIR__ . '/nameserver.php';


