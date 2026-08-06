{{-- resources/views/frontend/orders/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Order Details - MyShop')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">
        <h2>
            Order #{{ $order->order_number }}
        </h2>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Payment:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            Products
        </div>

        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            {{ $item->product->name ?? 'Deleted Product' }}
                        </td>

                        <td>
                            ${{ number_format($item->price,2) }}
                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>

                        <td>
                            ${{ number_format($item->total,2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div class="card-footer text-end">
            <h5>
                Total:
                ${{ number_format($order->total_amount,2) }}
            </h5>
        </div>
    </div>

</div>
@endsection