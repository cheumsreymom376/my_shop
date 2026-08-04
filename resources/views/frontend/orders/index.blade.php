{{-- resources/views/frontend/orders/index.blade.php --}}
@extends('layouts.app')

@section('title', 'My Orders - MyShop')

@section('content')
<div class="container py-4">
    <h1 class="h2 mb-4"><i class="bi bi-box"></i> My Orders</h1>

    @if($orders->count() > 0)
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <strong>{{ $order->order_number }}</strong>
                                    </td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-box" style="font-size: 80px; color: #dee2e6;"></i>
            <h3 class="text-muted mt-3">No orders yet</h3>
            <p class="text-muted">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-shop"></i> Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection