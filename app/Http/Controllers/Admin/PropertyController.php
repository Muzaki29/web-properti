<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class PropertyController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Property::class);

        $properties = Property::with(['category', 'primaryImage', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $this->authorize('create', Property::class);

        $categories = Category::where('is_active', true)->get();
        $users = User::all();

        return view('admin.properties.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Property::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'property_type' => 'required|string',
            'status' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'land_size' => 'nullable|numeric',
            'building_size' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        Property::create($validated);

        return redirect()->route('admin.properties')->with('success', 'Property berhasil dibuat!');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $this->authorize('update', $property);

        $categories = Category::where('is_active', true)->get();
        $users = User::all();

        return view('admin.properties.edit', compact('property', 'categories', 'users'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $this->authorize('update', $property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'property_type' => 'required|string',
            'status' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'land_size' => 'nullable|numeric',
            'building_size' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $property->update($validated);

        return redirect()->route('admin.properties')->with('success', 'Property berhasil diupdate!');
    }

    public function destroy($id)
    {
        $property = Property::with('images')->findOrFail($id);
        $this->authorize('delete', $property);

        // Keep legacy behavior: remove image records and files before deleting property.
        try {
            $imageService = app(\App\Services\PropertyImageService::class);
            foreach ($property->images as $image) {
                $imageService->deleteImage($image);
            }

            $property->delete();
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('admin.properties')->with('error', 'Gagal menghapus property. Silakan coba lagi.');
        }

        return redirect()->route('admin.properties')->with('success', 'Property berhasil dihapus!');
    }
}

