{{-- resources/views/frontend/checkout/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Checkout - MyShop')

@section('content')
<div class="container py-4">
    <h1 class="h2 mb-4"><i class="bi bi-credit-card"></i> Checkout</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" 
                                      name="shipping_address" 
                                      rows="3" 
                                      required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" 
                                    name="payment_method" 
                                    required>
                                <option value="">Select Payment Method</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>
                                    Credit Card
                                </option>
                                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>
                                    PayPal
                                </option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                    Bank Transfer
                                </option>
                                <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>
                                    Cash on Delivery
                                </option>
                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle"></i> Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>${{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                    </div>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-3">
                        <i class="bi bi-arrow-left"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection