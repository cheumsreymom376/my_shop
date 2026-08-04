{{-- resources/views/frontend/products/show.blade.php --}}
@extends('layouts.app')

@section('title', $product->name . ' - MyShop')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <!-- Product Image -->
            <div class="card">
                <div class="card-body p-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="img-fluid rounded" 
                             alt="{{ $product->name }}"
                             style="width: 100%; height: 400px; object-fit: contain;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Product Info -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    @if($product->category)
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.category', $product->category->slug) }}">
                                {{ $product->category->name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
                </ol>
            </nav>

            <h1 class="h2 mb-3">{{ $product->name }}</h1>
            
            <div class="mb-3">
                @if($product->sale_price)
                    <span class="text-muted text-decoration-line-through h5">${{ number_format($product->price, 2) }}</span>
                    <span class="text-danger h3">${{ number_format($product->sale_price, 2) }}</span>
                    <span class="badge bg-danger ms-2">Sale</span>
                @else
                    <span class="h3 text-primary">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <div class="mb-3">
                @if($product->stock > 0)
                    <span class="badge bg-success">In Stock ({{ $product->stock }} available)</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>

            <div class="mb-4">
                <h5>Description</h5>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            <!-- Add to Cart -->
            @auth
                @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="quantity" 
                                       name="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}">
                            </div>
                            <div class="col-md-8 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <button class="btn btn-secondary btn-lg w-100" disabled>
                        <i class="bi bi-x-circle"></i> Out of Stock
                    </button>
                @endif
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Please <a href="{{ route('login') }}">login</a> to add items to cart.
                </div>
            @endauth

            <!-- Product Meta -->
            <div class="mt-4 pt-3 border-top">
                <p class="text-muted small mb-1">
                    <i class="bi bi-tag"></i> Category: {{ $product->category->name ?? 'Uncategorized' }}
                </p>
                <p class="text-muted small mb-1">
                    <i class="bi bi-hash"></i> SKU: {{ $product->id }}
                </p>
                <p class="text-muted small">
                    <i class="bi bi-clock"></i> Added: {{ $product->created_at->format('F d, Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($related_products->count() > 0)
    <section class="related-products mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row">
            @foreach($related_products as $related)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <a href="{{ route('products.show', $related->slug) }}" class="text-decoration-none">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                     class="card-img-top product-img" 
                                     alt="{{ $related->name }}">
                            @else
                                <div class="bg-light product-img d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image" style="font-size: 40px; color: #ccc;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title text-dark">{{ Str::limit($related->name, 20) }}</h6>
                                <p class="fw-bold text-primary">${{ number_format($related->final_price, 2) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection