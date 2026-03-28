<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// Legacy image-management endpoints retained for compatibility.
// Security is enforced via auth+admin middleware.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/properties/{id}/images', [PropertyController::class, 'manageImages'])->name('properties.manage-images');
    Route::post('/properties/{id}/images', [PropertyController::class, 'uploadImages'])->name('properties.upload-images');
    Route::delete('/images/{id}', [PropertyController::class, 'deleteImage'])->name('images.delete');
    Route::post('/images/{id}/set-primary', [PropertyController::class, 'setPrimaryImage'])->name('images.set-primary');
});

