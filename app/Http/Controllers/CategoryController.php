<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $properties = Property::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['category', 'primaryImage'])
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'properties'));
    }
}
