@extends('layouts.app')

@section('content')
    <div class="container ">
        <h2 class="col-lg-2 py-4">Products</h2>
        <div class="table-container">
            <table class="table tables-custom">
                <thead>
                    <tr>
                        <th class="lead">Product</th>
                        <th class="lead">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="lead">
                                {{ $order->product->title }}
                            </td>
                            <td @if ($order->orderStatus->name === 'Accepted') style="background: #66ff5b;" @elseif($order->orderStatus->name === 'Declined') style="background: #ff3242;" @else style="background: #ffdc32;" @endif>
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
        <div class="my-5 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
