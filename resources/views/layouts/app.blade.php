<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--LiveWireStyles-->
    @livewireStyles
</head>

<body>
    <header>
        <div class="header-first">
            <div class="container d-flex">
                <div>
                    @guest
                        <p>It's important where you buy.</p>
                    @endguest
                    @auth
                        <p>Hello {{ auth()->user()->name }}!</p>
                    @endauth
                </div>
                @guest
                    <div class="d-flex ml-auto mr-2">
                        <a href="{{ route('register') }}">Sign Up</a>
                        <a href="{{ route('login') }}">Log In</a>
                    </div>
                @endguest

                @auth
                    <form class="logout ml-auto" action="{{ route('logout') }}" method="GET">
                        <button>Logout</button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- NAV -->
        <nav>
            <div class="nav-container container d-flex">
                <h1>
                    <a href="/">Shop</a>
                </h1>
                <h2 href="#" class="menu-icon"><i class="fas fa-bars"></i></h2>
                @guest
                    <ul class="d-flex-custom header-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Products</a></li>
                        <li><a href="{{ route('contactUs') }}">Contact us</a></li>
                    </ul>
                @endguest
                @auth
                    @if (auth()->user()->role_id == 3)
                        <ul class="d-flex-custom header-links">
                            <li><a href="/">Home</a></li>
                            <li><a href="/products">Products</a></li>
                            <li><a href="/orders">Orders</a></li>
                            <li><a href="{{ route('contactUs') }}">Contact us</a></li>
                        </ul>
                    @endif
                    @if (auth()->user()->role_id == 2)
                        <ul class="d-flex-custom header-links">
                            <li><a href="/admin/product">Modify products</a></li>
                            <li><a href="/admin/product/trashed">Trashed products</a></li>
                            <li><a href="/admin/orders">Orders</a></li>
                            <li><a href="/admin/messages">Messages</a></li>
                        </ul>
                    @endif

                    @if (auth()->user()->role_id == 1)
                        <ul class="d-flex-custom header-links">
                            <li><a href="/admin/user">Users</a></li>
                            <li><a href="/admin/product">Modify products</a></li>
                            <li><a href="/admin/product/trashed">Trashed products</a></li>
                            <li><a href="/admin/orders">Orders</a></li>
                            <li><a href="/admin/messages">Messages</a></li>
                        </ul>
                    @endif
                @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row w-100 justify-content-between text-center">
                <p class="col-md-3 text-md-start"><i class="fas fa-user"></i>Test User</p>
                <p class="col-md-3"><i class="fas fa-phone-alt"></i> +5612734235</p>
                <p class="col-md-3"><i class="fas fa-envelope"></i> testuser@gmail.com</p>
                <p class="col-md-3 text-md-end pr-0"><i class="fas fa-map-marker-alt"></i> 17st. 6123</p>
            </div>
        </div>
    </footer>
</body>

<script>
    const resizeFullHeight = () => {
        /** @type {HTMLElement} */
        const header = document.querySelector("header");
        /** @type {HTMLElement} */
        const footer = document.querySelector("footer");
        /** @type {HTMLElement} */
        const main = document.querySelector('main');
        const mainHeight =
            window.innerHeight - (header.clientHeight + footer.clientHeight);

        main.style.minHeight = `${mainHeight}px`;
    };
    window.onload = () => {
        resizeFullHeight('register-main-container')
    }
    window.onresize = () => {
        resizeFullHeight('register-main-container')
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>

<!--LiveWireScripts-->
@livewireScripts

<!--SweetAlert-->
@include('sweetalert::alert')
</body>

</html>
