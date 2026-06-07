<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display the dashboard home with stats, filtering, and search.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by name, wash type or description
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('wash_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        // Allowed fields for safety
        if (in_array($sortBy, ['name', 'price', 'stock', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Fetch products
        $products = $query->get();

        // Calculate statistics
        $stats = [
            'total_products' => Product::count(),
            'total_value' => Product::sum(\DB::raw('price * stock')),
            'low_stock_count' => Product::where('stock', '<=', 5)->count(),
            'total_categories' => Product::distinct('category')->count('category'),
        ];

        // Unique categories for the dropdown filter
        $categories = Product::distinct()->pluck('category');

        return view('dashboard.index', compact('products', 'stats', 'categories'));
    }

    /**
     * Store a newly created product in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'required|string|max:255',
            'wash_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:2048'
        ]);

        Product::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Produk denim "' . $request->name . '" berhasil ditambahkan ke inventaris!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('dashboard.edit', compact('product'));
    }

    /**
     * Update the specified product in database.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'required|string|max:255',
            'wash_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:2048'
        ]);

        $product->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Produk denim "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified product from database.
     */
    public function destroy(Product $product)
    {
        $productName = $product->name;

        $product->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Produk denim "' . $productName . '" telah dihapus dari inventaris.');
    }
}
