{{-- resources/views/frontend/products/category.blade.php --}}
@extends('layouts.app')

@section('title', $category->name . ' - MyShop')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Category Header -->
        <div class="col-12 mb-4">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row align-items-center">
                        @if($category->image)
                            <div class="col-md-2">
                                <img src="{{ asset('images/categories/' . $category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="img-fluid rounded-circle"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="col-md-10">
                        @else
                            <div class="col-md-12">
                        @endif
                            <h1 class="h2 mb-2">{{ $category->name }}</h1>
                            <p class="text-muted mb-0">{{ $category->description ?? 'Browse our collection of ' . $category->name }}</p>
                            <span class="badge bg-primary mt-2">{{ $products->total() }} products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to All Products
                </a>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card product-card h-100">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                                @if($product->image)
                                    <img src="{{ asset('images/products/' . $product->image) }}" 
                                         class="card-img-top product-img" 
                                         alt="{{ $product->name }}">
                                @else
                                    <div class="bg-light product-img d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image" style="font-size: 50px; color: #ccc;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ Str::limit($product->name, 25) }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($product->sale_price)
                                                <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                                <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                            @else
                                                <span class="fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                        @if($product->stock > 0)
                                            <span class="badge bg-success">In Stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @auth
                                @if($product->stock > 0)
                                    <div class="card-footer bg-transparent border-top-0">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-cart-plus"></i> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-box-seam" style="font-size: 60px; color: #dee2e6;"></i>
                        <h4 class="text-muted mt-3">No products in this category</h4>
                        <p class="text-muted">Check back later for new products.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-arrow-left"></i> Back to Products
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection