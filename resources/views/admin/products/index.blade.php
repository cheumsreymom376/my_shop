
@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-box-seam"></i> Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; border-radius: 5px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                    </td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($product->sale_price)
                                            <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                            <br>
                                            <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                        @else
                                            <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->stock > 10)
                                            <span class="badge bg-success">{{ $product->stock }} in stock</span>
                                        @elseif($product->stock > 0)
                                            <span class="badge bg-warning">{{ $product->stock }} in stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', $product) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.products.delete', $product) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-box-seam" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h4 class="text-muted mt-3">No products found</h4>
                    <p class="text-muted">Start by adding your first product.</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-circle"></i> Add Product
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection