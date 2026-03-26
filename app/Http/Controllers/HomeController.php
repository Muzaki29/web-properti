<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category', 'primaryImage'])
            ->latest()
            ->take(6)
            ->get();

        $latestProperties = Property::where('is_active', true)
            ->with(['category', 'primaryImage'])
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('home', compact('featuredProperties', 'latestProperties', 'categories'));
    }
}
