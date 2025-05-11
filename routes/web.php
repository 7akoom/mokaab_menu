<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminAuthController, AdminCompanyController};

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'));
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::prefix('companies')->controller(AdminCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('companies.index');
        Route::get('companies', 'create')->name('companies.create');
        Route::post('companies', 'store')->name('companies.store');
        Route::get('companies/{company}', 'edit')->name('companies.edit');
        Route::put('companies/{company}', 'update')->name('companies.update');
        Route::delete('companies/{company}', 'destroy')->name('companies.destroy');
    });
});
