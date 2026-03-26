<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Auth Routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

// Super Admin Login
Route::get('/super-admin', [\App\Http\Controllers\AuthController::class, 'superAdminAccess'])->name('super-admin');
Route::post('/super-admin', [\App\Http\Controllers\AuthController::class, 'superAdminLogin'])->name('super-admin.login');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// Image Management Routes (Public - akan dipindah ke admin nanti)
Route::get('/properties/{id}/images', [PropertyController::class, 'manageImages'])->name('properties.manage-images');
Route::post('/properties/{id}/images', [PropertyController::class, 'uploadImages'])->name('properties.upload-images');
Route::delete('/images/{id}', [PropertyController::class, 'deleteImage'])->name('images.delete');
Route::post('/images/{id}/set-primary', [PropertyController::class, 'setPrimaryImage'])->name('images.set-primary');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Properties
    Route::get('/properties', [\App\Http\Controllers\AdminController::class, 'properties'])->name('admin.properties');
    Route::get('/properties/create', [\App\Http\Controllers\AdminController::class, 'createProperty'])->name('admin.properties.create');
    Route::post('/properties', [\App\Http\Controllers\AdminController::class, 'storeProperty'])->name('admin.properties.store');
    Route::get('/properties/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editProperty'])->name('admin.properties.edit');
    Route::put('/properties/{id}', [\App\Http\Controllers\AdminController::class, 'updateProperty'])->name('admin.properties.update');
    Route::delete('/properties/{id}', [\App\Http\Controllers\AdminController::class, 'deleteProperty'])->name('admin.properties.delete');
    
    // Property Images
    Route::get('/properties/{id}/images', [\App\Http\Controllers\AdminController::class, 'manageImages'])->name('admin.properties.images');
    Route::post('/properties/{id}/images', [\App\Http\Controllers\AdminController::class, 'uploadImages'])->name('admin.properties.upload-images');
    Route::delete('/images/{id}', [\App\Http\Controllers\AdminController::class, 'deleteImage'])->name('admin.images.delete');
    Route::post('/images/{id}/set-primary', [\App\Http\Controllers\AdminController::class, 'setPrimaryImage'])->name('admin.images.set-primary');
    
    // Categories
    Route::get('/categories', [\App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [\App\Http\Controllers\AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [\App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [\App\Http\Controllers\AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [\App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
});
