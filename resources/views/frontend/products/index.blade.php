{{-- resources/views/frontend/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Products - MyShop')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-filters"></i> Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('products.index') }}" class="text-decoration-none {{ !request()->route('slug') ? 'fw-bold text-primary' : '' }}">
                                All Products
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li class="mb-2">
                            <a href="{{ route('products.category', ['slug' => $category->slug]) }}"
                                class="text-decoration-none {{ request()->route('slug') == $category->slug ? 'fw-bold text-primary' : '' }}">
                                <i class="bi bi-tag"></i> {{ $category->name }}
                                <span class="badge bg-secondary float-end">{{ $category->products_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Products</h1>
                <span class="text-muted">{{$products->count() }} products found</span>
            </div>

            <div class="row">
                @forelse($products as $product)
                <div class="col-md-4 col-sm-6 mb-4">
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
                                <h5 class="card-title text-dark">{{ Str::limit($product->name, 25) }}</h5>
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
                    <h4 class="text-muted mt-3">No products found</h4>
                    <p class="text-muted">Please check back later for new products.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            
        </div>
    </div>
</div>
@endsection