<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $data = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
            'recent_products' => Product::with('category')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}