<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class FrontendProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('frontend.products.index', compact(
            'products',
            'categories'
        ));
    }


    public function category($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::where('is_active', true)->get();

        $products = Product::where('category_id', $id)
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('frontend.products.index', compact(
            'products',
            'categories',
            'category'
        ));
    }
}
