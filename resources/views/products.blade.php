@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-3 search-products-form">
            <h2 class="col-lg-2">Products</h2>
            <form action="{{ route('products') }}" method="GET" class="col-lg-10 d-flex">
                <input type="text" class="input-custom" name="search" placeholder="Search products"
                    style="background-color: #f8fafc">
                <button class="ml-5 btn-primary-custom">Search</button>
            </form>
        </div>

        <div class="row mt-lg-3 mb-lg-5 search-products">
            @foreach ($products as $product)
                <article class="product col-md-4">
                    <a href="#" @auth data-toggle="modal" data-target="#newOrder{{ $product->id }} @endauth">
                        <div class="product-image-container">
                            <img src="{{ $product->featured }}" alt="kompjuter1" />
                        </div>
                        <h3>{{ $product->title }}</h3>
                        <h3>{{ $product->price }}$</h3>
                    </a>
                    @guest
                        <p>Please first register to buy products</p>
                    @endguest
                    @auth
                    <!-- Button trigger modal for new order -->
                        <a href="#" class="mr-2" data-toggle="modal" data-target="#newOrder{{ $product->id }}">Order now</a>
                        <!-- Make new order -->
                        <div class="modal fade" id="newOrder{{ $product->id }}" tabindex="-1" aria-labelledby="newOrder{{ $product->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">We need more informations...</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('order.store') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="order_status_id" value="3">

                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input type="text" name="location" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="number">Number</label>
                                                <input type="text" name="number" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="reqQuantity">Quantity</label>
                                                <input type="number" step="1" name="reqQuantity" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="btn-order-products" class="btn-primary-custom">Buy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @auth
                        <!-- Make new order -->
                        <div class="modal fade" id="newOrder{{ $product->id }}" tabindex="-1"
                            aria-labelledby="newOrder{{ $product->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">We need more informations...</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('order.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="order_status_id" value="3">

                                            <div class="form-group">
                                                <label class="float-left" for="location">Location</label>
                                                <input type="text" name="location" class="form-control w-100">
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left" for="address">Address</label>
                                                <input type="text" name="address" class="form-control w-100">
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left" for="number">Number</label>
                                                <input type="text" name="number" class="form-control w-100">
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left" for="reqQuantity">Quantity</label>
                                                <input type="number" step="1" name="reqQuantity" class="form-control w-100">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="btn-order-products" class="btn-primary-custom">Order
                                                    now!</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </article>
            @endforeach
        </div>
        <div class="my-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    </div>
@endsection
