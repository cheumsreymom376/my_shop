
@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-tags"></i> Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" 
                                                 alt="{{ $category->name }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; border-radius: 5px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                        <br>
                                        <small class="text-muted">Slug: {{ $category->slug }}</small>
                                    </td>
                                    <td>{{ Str::limit($category->description, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->products_count }}</span>
                                    </td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.categories.edit', $category) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.delete', $category) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                    <i class="bi bi-tags" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h4 class="text-muted mt-3">No categories found</h4>
                    <p class="text-muted">Start by adding your first category.</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-circle"></i> Add Category
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection