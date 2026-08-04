<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();
        
        $featured_products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('frontend.home', compact('products', 'featured_products', 'categories'));
    }

    public function viewProducts()
    {
        $products = Product::where('is_active', true)
            ->with('category')
            ->paginate(12);
        
        $categories = Category::where('is_active', true)->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'related_products'));
    }

    public function productsByCategory($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->paginate(12);

        $categories = Category::where('is_active', true)->get();

        return view('frontend.products.category', compact('category', 'products', 'categories'));
    }
}