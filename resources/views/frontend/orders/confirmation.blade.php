{{-- resources/views/frontend/orders/confirmation.blade.php --}}
@extends('layouts.app')

@section('title', 'Order Confirmation - MyShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <i class="bi bi-check-circle" style="font-size: 80px; color: #28a745;"></i>
        <h1 class="mt-3">Order Placed Successfully!</h1>
        <p class="text-muted">Thank you for your order. We'll send you a confirmation email shortly.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order Number:</strong>
                            <span class="text-primary">{{ $order->order_number }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong>
                            {{ $order->created_at->format('F d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-warning">Pending</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Payment:</strong>
                            <span class="badge bg-warning">Pending</span>
                        </div>
                    </div>

                    <h6 class="mt-4">Items Ordered</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th>${{ number_format($order->total_amount, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-3">
                        <h6>Shipping Address</h6>
                        <p class="text-muted">{{ $order->shipping_address }}</p>
                    </div>

                    <div class="mt-3">
                        <h6>Payment Method</h6>
                        <p class="text-muted">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-primary">
                    <i class="bi bi-box"></i> View My Orders
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-house"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection