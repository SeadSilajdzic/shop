@extends('layouts.app')

@section('content')
    <!-- MAIN -->
    <div class="main">
        <div class="register-main-container">
            <div class="register-main mx-auto">
                <h2 class="mb-3">Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="input-custom @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                    @error('email')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="input-custom" />

                    @error('password')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <button type="submit" class="btn-primary-custom w-100 mt-3">Login</button>
                </form>
            </div>
        </div>
    </div>

@endsection
