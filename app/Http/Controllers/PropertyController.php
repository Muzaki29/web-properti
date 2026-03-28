<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Http\Requests\PropertyImageUploadRequest;
use App\Http\Requests\PropertySearchRequest;
use App\Services\PropertyImageService;
use App\Services\PropertyQueryService;
use Throwable;

class PropertyController extends Controller
{
    public function index(PropertySearchRequest $request)
    {
        $properties = app(PropertyQueryService::class)->search($request, 12);
        $categories = Category::where('is_active', true)->get();

        return view('properties.index', compact('properties', 'categories'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'images', 'user'])
            ->firstOrFail();

        // Increment views
        $property->increment('views');

        // Get related properties
        $relatedProperties = Property::where('category_id', $property->category_id)
            ->where('id', '!=', $property->id)
            ->where('is_active', true)
            ->with(['category', 'primaryImage'])
            ->take(4)
            ->get();

        return view('properties.show', compact('property', 'relatedProperties'));
    }

    public function uploadImages(PropertyImageUploadRequest $request, $id)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);

        $property = Property::findOrFail($id);
        try {
            $uploadedImages = app(PropertyImageService::class)->uploadImages(
                $property,
                $request->file('images', []),
                (bool) $request->boolean('set_first_as_primary'),
                $request->filled('is_primary') ? (int) $request->input('is_primary') : null
            );
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload gambar. Silakan coba lagi.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'images' => $uploadedImages
        ]);
    }

    public function deleteImage($id)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);

        $image = PropertyImage::findOrFail($id);
        try {
            app(PropertyImageService::class)->deleteImage($image);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus gambar. Silakan coba lagi.'
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus'
        ]);
    }

    public function setPrimaryImage($id)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);

        $image = PropertyImage::findOrFail($id);
        try {
            app(PropertyImageService::class)->setPrimaryImage($image);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah gambar utama. Silakan coba lagi.'
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar utama berhasil diubah'
        ]);
    }

    public function manageImages($id)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);

        $property = Property::with('images')->findOrFail($id);
        return view('properties.manage-images', compact('property'));
    }
}
