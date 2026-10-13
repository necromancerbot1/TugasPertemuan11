<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class EditorDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products'=> Product::active()->count(),
            'low_stock'      => Product::where('stock', '<', 10)->count(),
            'total_categories'=> Category::count(),
        ];

        $recentProducts = Product::with('category')->latest()->take(6)->get();

        return view('editor.dashboard', compact('stats', 'recentProducts'));
    }
}
