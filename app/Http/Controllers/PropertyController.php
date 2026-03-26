<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::where('is_active', true)
            ->with(['category', 'primaryImage']);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by property type
        if ($request->has('type') && $request->type) {
            $query->where('property_type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $properties = $query->paginate(12);
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

    public function uploadImages(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB
        ]);

        $uploadedImages = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('properties', $filename, 'public');
                
                $isPrimary = $request->input('is_primary') == $index || ($index == 0 && $property->images()->count() == 0);
                
                // Jika set primary, unset yang lain
                if ($isPrimary) {
                    $property->images()->update(['is_primary' => false]);
                }
                
                $image = PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'image_name' => $file->getClientOriginalName(),
                    'order' => $property->images()->count(),
                    'is_primary' => $isPrimary,
                ]);
                
                $uploadedImages[] = $image;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'images' => $uploadedImages
        ]);
    }

    public function deleteImage($id)
    {
        $image = PropertyImage::findOrFail($id);
        
        // Hapus file dari storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus'
        ]);
    }

    public function setPrimaryImage($id)
    {
        $image = PropertyImage::findOrFail($id);
        
        // Unset semua primary
        $image->property->images()->update(['is_primary' => false]);
        
        // Set yang dipilih sebagai primary
        $image->update(['is_primary' => true]);
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar utama berhasil diubah'
        ]);
    }

    public function manageImages($id)
    {
        $property = Property::with('images')->findOrFail($id);
        return view('properties.manage-images', compact('property'));
    }
}
