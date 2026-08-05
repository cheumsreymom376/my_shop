{{-- resources/views/frontend/cart/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Shopping Cart - MyShop')

@section('content')
<div class="container py-4">
    <h1 class="h2 mb-4"><i class="bi bi-cart"></i> Shopping Cart</h1>

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

    @if($cartItems->count() > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="row align-items-center mb-3 pb-3 border-bottom">
                        <div class="col-md-2">
                            @if($item->product && $item->product->image)
                            <img src="{{ asset('images/products/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">

                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                style="height: 80px;">
                                <i class="bi bi-image" style="font-size: 30px; color: #ccc;"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-0">{{ $item->product->name }}</h6>
                            <small class="text-muted">{{ $item->product->category->name ?? 'Uncategorized' }}</small>
                        </div>
                        <div class="col-md-2">
                            <span class="fw-bold">${{ number_format($item->price, 2) }}</span>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number"
                                    name="quantity"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    max="{{ $item->product->stock }}"
                                    class="form-control form-control-sm me-2"
                                    style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2 text-end">
                            <div class="fw-bold text-primary">${{ number_format($item->total, 2) }}</div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mt-1">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-credit-card"></i> Proceed to Checkout
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="bi bi-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-cart" style="font-size: 80px; color: #dee2e6;"></i>
        <h3 class="text-muted mt-3">Your cart is empty</h3>
        <p class="text-muted">Looks like you haven't added any items to your cart yet.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-shop"></i> Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection