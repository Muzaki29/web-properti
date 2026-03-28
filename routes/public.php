<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

// Super admin login
Route::get('/super-admin', [AuthController::class, 'superAdminAccess'])->name('super-admin');
Route::post('/super-admin', [AuthController::class, 'superAdminLogin'])->name('super-admin.login')->middleware('throttle:login');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

Route::post('/inquiries', [InquiryController::class, 'store'])
    ->middleware('throttle:inquiries')
    ->name('inquiries.store');

