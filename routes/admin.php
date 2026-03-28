<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\PropertyImageController as AdminPropertyImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Properties
    Route::get('/properties', [AdminPropertyController::class, 'index'])->name('admin.properties');
    Route::get('/properties/create', [AdminPropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('/properties', [AdminPropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/properties/{id}/edit', [AdminPropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('/properties/{id}', [AdminPropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('/properties/{id}', [AdminPropertyController::class, 'destroy'])->name('admin.properties.delete');

    // Property images
    Route::get('/properties/{id}/images', [AdminPropertyImageController::class, 'index'])->name('admin.properties.images');
    Route::post('/properties/{id}/images', [AdminPropertyImageController::class, 'upload'])->name('admin.properties.upload-images');
    Route::delete('/images/{id}', [AdminPropertyImageController::class, 'delete'])->name('admin.images.delete');
    Route::post('/images/{id}/set-primary', [AdminPropertyImageController::class, 'setPrimary'])->name('admin.images.set-primary');

    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.delete');
});

