
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
        <span class="text-muted">Welcome back, {{ Auth::user()->name }}</span>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Users</h6>
                        <h2 class="mb-0">{{ $total_users }}</h2>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Products</h6>
                        <h2 class="mb-0">{{ $total_products }}</h2>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Categories</h6>
                        <h2 class="mb-0">{{ $total_categories }}</h2>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="bi bi-tags"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Orders</h6>
                        <h2 class="mb-0">{{ $total_orders }}</h2>
                    </div>
                    <div class="stat-icon text-info">
                        <i class="bi bi-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Orders</h5>
        </div>
        <div class="card-body">
            @if($recent_orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">No orders yet.</p>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h5><i class="bi bi-lightning-fill"></i> Quick Actions</h5>
        </div>
        <div class="col-md-3 col-sm-6 mb-2">
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-2">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success w-100">
                <i class="bi bi-plus-circle"></i> Add Category
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info w-100">
                <i class="bi bi-box-seam"></i> Manage Products
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-warning w-100">
                <i class="bi bi-tags"></i> Manage Categories
            </a>
        </div>
    </div>
@endsection