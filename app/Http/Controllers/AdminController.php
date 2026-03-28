<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyImageUploadRequest;
use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyImage;
use App\Models\User;
use App\Services\PropertyImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'total_properties' => Property::count(),
            'active_properties' => Property::where('is_active', true)->count(),
            'featured_properties' => Property::where('is_featured', true)->count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
        ];

        $recentProperties = Property::with(['category', 'primaryImage'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProperties'));
    }

    // ============ PROPERTIES MANAGEMENT ============
    public function properties()
    {
        $properties = Property::with(['category', 'primaryImage', 'user'])
            ->latest()
            ->paginate(15);
        
        return view('admin.properties.index', compact('properties'));
    }

    public function createProperty()
    {
        $categories = Category::where('is_active', true)->get();
        $users = User::all();
        return view('admin.properties.create', compact('categories', 'users'));
    }

    public function storeProperty(Request $request)
    {
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

        $property = Property::create($validated);

        return redirect()->route('admin.properties')->with('success', 'Property berhasil dibuat!');
    }

    public function editProperty($id)
    {
        $property = Property::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $users = User::all();
        return view('admin.properties.edit', compact('property', 'categories', 'users'));
    }

    public function updateProperty(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        
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

    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);
        
        // Hapus semua gambar
        foreach ($property->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }
        
        $property->delete();

        return redirect()->route('admin.properties')->with('success', 'Property berhasil dihapus!');
    }

    // ============ CATEGORIES MANAGEMENT ============
    public function categories()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'nullable|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dibuat!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diupdate!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        
        // Cek apakah ada property yang menggunakan kategori ini
        if ($category->properties()->count() > 0) {
            return redirect()->route('admin.categories')->with('error', 'Tidak dapat menghapus kategori yang masih digunakan oleh property!');
        }
        
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus!');
    }

    // ============ IMAGES MANAGEMENT ============
    public function manageImages($id)
    {
        $property = Property::with('images')->findOrFail($id);
        return view('admin.properties.images', compact('property'));
    }

    public function uploadImages(PropertyImageUploadRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        app(PropertyImageService::class)->uploadImages(
            $property,
            $request->file('images', []),
            (bool) $request->boolean('set_first_as_primary'),
            null
        );

        return redirect()->route('admin.properties.images', $property->id)
            ->with('success', 'Gambar berhasil diupload!');
    }

    public function deleteImage($id)
    {
        $image = PropertyImage::findOrFail($id);
        app(PropertyImageService::class)->deleteImage($image);

        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function setPrimaryImage($id)
    {
        $image = PropertyImage::findOrFail($id);
        app(PropertyImageService::class)->setPrimaryImage($image);

        return redirect()->back()->with('success', 'Gambar utama berhasil diubah!');
    }
}
