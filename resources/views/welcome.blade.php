@extends('layouts.app')

@section('content')
    <div class=" text-center home-hero">
        <div class="overlay"></div>
        <div class="text-light">
            <div class="col-lg-6 mx-auto">
                <h1 class="display-5 fw-bold mb-3">Welcome to DDD shop</h1>
                <p class="lead mb-4 pb-4">Professional services of desinfection desinsection and deratization of residential
                    and
                    business premises. Guaranteed quality of services at affordable prices. </p>
                <p class="lead mb-4">Check out our shop:</p>
                <a class="btn-primary-custom mt-3 ml-3" href="/products">Products</a>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-3 mb-5">
        <div class="home-cards row text-center justify-content-between">
            <div class="col-md-3 card-custom mb-4">
                <div class="w-50 m-auto">
                    <img src="{{ asset('images/dezinfekcija.png') }}" alt="dezinfekcija">
                </div>
                <h2 class="danger-custom lead ">Desinfection</h2>
                <p class="lead">
                    <b>DDD</b> provides professional services desinfection of business premises, medicational
                    premises and private premises
                </p>
            </div>
            <div class="col-md-3 card-custom mb-4">
                <div class="w-50 m-auto">
                    <img src="{{ asset('images/deratizacija.png') }}" alt="deratizacija">
                </div>
                <h2 class="danger-custom lead">Deratization</h2>
                <p class="lead">
                    <b>DDD</b> provides professional services desinfection of business premises, medicational
                    premises and private premises
                </p>
            </div>
            <div class="col-md-3 card-custom mb-4">
                <div class="w-50 m-auto">
                    <img src="{{ asset('images/dezinsekcija.png') }}" alt="dezinsekcija">
                </div>
                <h2 class="danger-custom lead">Dezinsection</h2>
                <p class="lead">
                    <b>DDD</b> provides professional services desinfection of business premises, medicational
                    premises and private premises
                </p>
            </div>
        </div>
    </div>

    {{-- I would use here tiny slider but as project should be done with bootstrap I used their carousel --}}
    {{-- Variable declared to set only onfirst item class active --}}
    @php
    $productCounter = 0;
    @endphp
    <div class="container mb-5">
        <h2 class="text-center display-6 fw-bold mb-3">New products:</h2>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($products as $product)
                    <div class="carousel-item @if ($productCounter == 0) active  @endif">
                        @php
                            $productCounter += 1;
                        @endphp
                        <img class="d-block w-100" src="{{ $product->featured }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $product->title }}</h5>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

@endsection
