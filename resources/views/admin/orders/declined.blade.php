@extends('layouts.app')

@section('content')

    <div class="container my-4">
        <div class="row mb-2 mb-xl-3">
            <div>
                <h1 class="h3 mb-3">Orders management</h1>
                <div>
                    <a class="btn-primary-custom mb-4" style="color:#fff;" href="/admin/orders/accepted">Accepted orders</a>
                    <div class="my-4"></div>
                    <a class="btn-primary-custom" style="color:#fff;" href="/admin/orders/declined">Declined orders</a>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="table tables-custom table-container">
                <thead>
                    <tr>
                        <th class="lead">User</th>
                        <th class="lead">Product</th>
                        <th class="lead">Quantity</th>
                        <th class="lead">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="lead">
                                {{ $order->user->name }}
                            </td>
                            <td class="lead">
                                {{ $order->product->title }}
                            </td>
                            <td class="lead">
                                {{ $order->reqQuantity }}
                            </td>
                            <td style="background: #ff3242;">
                                {{ $order->orderStatus->name }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>There are no more order requests :) Great Job!</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

    @include('partials.errors')

@endsection
