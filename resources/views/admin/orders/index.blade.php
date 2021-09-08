@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4 mt-4">
            <h1 class="h3 mb-3">Orders management</h1>
            <div>
                <a class="btn-primary-custom mb-4" style="color:#fff;" href="/admin/orders/accepted">Accepted orders</a>
                <div class="my-4"></div>
                <a class="btn-primary-custom" style="color:#fff;" href="/admin/orders/declined">Declined orders</a>
            </div>
        </div>
    </div>
    <div class="container table-container">
        <table class="table">
            <thead>
                <tr>
                    <th class="lead">User</th>
                    <th class="lead">Product</th>
                    <th class="lead">Quantity</th>
                    <th class="lead">In stock</th>
                    <th class="lead">Profit</th>
                    <th class="lead">Will remain</th>
                    <th class="lead">Status</th>
                    <th class="lead">Actions</th>
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
                        <td class="lead">
                            {{ $order->product->quantity }}
                        </td>
                        <td class="lead">
                            {{ $order->reqQuantity * $order->product->price }}$
                        </td>
                        <td class="lead">
                            {{ $order->product->quantity - $order->reqQuantity }}
                        </td>
                        <td @if ($order->orderStatus->name === 'Accepted') style="background: #66ff5b;" @elseif($order->orderStatus->name === 'Declined') style="background: #ff3242;" @else style="background: #ffdc32;" @endif>
                            {{ $order->orderStatus->name }}
                        </td>
                        <td class="d-flex">
                            <form action="{{ route('admin.order.accept', $order) }}" method="post">
                                @csrf

                                <button type="submit" name="btn-accept-order-request"
                                    class="btn-primary-custom">Accept</button>
                            </form>

                            <form action="{{ route('admin.order.decline', $order) }}" method="post">
                                @csrf

                                <button type="submit" name="btn-decline-order-request"
                                    class="btn btn-link btn-danger">Decline</button>
                            </form>
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

    <div class="mt-6 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

    @include('partials.errors')

@endsection
