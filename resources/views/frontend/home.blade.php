@extends('layouts.app')

@section('title', 'Home - MyShop')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay">
        <div class="container-fluid px-5">
            <div class="hero-content">

                <h1 class="display-4 fw-bold">
                    Welcome to MyShop
                </h1>

                <p class="lead">
                    Discover amazing products at great prices.
                    Shop now and enjoy exclusive deals!
                </p>

                <a href="{{ route('products.index') }}"
                   class="btn btn-light btn-lg mt-3">
                    <i class="bi bi-shop"></i>
                    Start Shopping
                </a>

            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Shop by Category</h2>
        <div class="row">
            @forelse($categories as $category)
            <div class="col-md-3 col-sm-6 mb-3">
                <a href="{{ route('products.category', $category->slug) }}" class="text-decoration-none">
                    <div class="card category-card h-100 text-center">
                        <div class="card-body">
                            @if($category->image)
                            <img src="{{ asset('images/categories/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                class="img-fluid rounded-circle mb-2"
                                style="width:80px;height:80px;object-fit:cover;">

                            @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-tag" style="font-size: 30px; color: #667eea;"></i>
                            </div>
                            @endif
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="text-muted small">{{ $category->products_count }} products</p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No categories available.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products -->
@if($featured_products->count() > 0)
<section class="featured-products py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            @foreach($featured_products as $product)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        @else
                        <div class="bg-light product-img d-flex align-items-center justify-content-center">
                            <i class="bi bi-image" style="font-size: 50px; color: #ccc;"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $product->name }}</h5>
                            <p class="text-muted small">{{ $product->category->name ?? 'Uncategorized' }}</p>
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
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Products -->
<section class="latest-products py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Latest Products</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row">
            @forelse($products as $product)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="card-img-top">
                        @else
                        <div class="bg-light product-img d-flex align-items-center justify-content-center">
                            <i class="bi bi-image" style="font-size: 50px; color: #ccc;"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ Str::limit($product->name, 30) }}</h5>
                            <p class="text-muted small">{{ $product->category->name ?? 'Uncategorized' }}</p>
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
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam" style="font-size: 60px; color: #dee2e6;"></i>
                <h4 class="text-muted mt-3">No products available</h4>
                <p class="text-muted">Check back later for new products.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="feature-item">
                    <i class="bi bi-truck feature-icon"></i>
                    <h5 class="mt-2">Free Shipping</h5>
                    <p class="text-muted small">On orders over $50</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="feature-item">
                    <i class="bi bi-arrow-repeat feature-icon"></i>
                    <h5 class="mt-2">Easy Returns</h5>
                    <p class="text-muted small">30-day return policy</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="feature-item">
                    <i class="bi bi-shield-lock feature-icon"></i>
                    <h5 class="mt-2">Secure Payment</h5>
                    <p class="text-muted small">100% secure transactions</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="feature-item">
                    <i class="bi bi-headset feature-icon"></i>
                    <h5 class="mt-2">24/7 Support</h5>
                    <p class="text-muted small">Dedicated support team</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection