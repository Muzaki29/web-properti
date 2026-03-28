<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
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
}

