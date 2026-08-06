@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2>
        <i class="bi bi-cart"></i>
        Orders
    </h2>


    <table class="table table-bordered mt-4">

        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>


        <tbody>

            @foreach($orders as $order)

            <tr>

                <td>
                    {{ $order->id }}
                </td>

                <td>
                    {{ $order->user->name ?? 'Guest' }}
                </td>

                <td>
                    ${{ number_format($order->total_amount, 2) }}
                </td>

                <td>
                    {{ $order->status }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>


</div>

@endsection