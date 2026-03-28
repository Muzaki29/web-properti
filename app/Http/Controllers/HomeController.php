<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $key = (string) config('cache.keys.home_landing');

        $data = Cache::remember($key, 300, function () {
            return [
                'featuredProperties' => Property::where('is_featured', true)
                    ->where('is_active', true)
                    ->with(['category', 'primaryImage'])
                    ->latest()
                    ->take(6)
                    ->get(),
                'latestProperties' => Property::where('is_active', true)
                    ->with(['category', 'primaryImage'])
                    ->latest()
                    ->take(8)
                    ->get(),
                'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            ];
        });

        return view('home', $data);
    }
}
