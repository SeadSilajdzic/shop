@extends('layouts.app')

@section('content')
    <!-- MAIN -->
    <div class="main">
        <div class="register-main-container">
            <div class="register-main mx-auto">
                <h2 class="mb-3">Register</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="input-custom" autocomplete="name" autofocus
                        value="{{ old('name') }}" />

                    @error('name')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror


                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" class="input-custom"
                        value="{{ old('username') }}" />

                    @error('username')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" class="input-custom" value="{{ old('email') }}"
                        autocomplete="email" />

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

                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="input-custom" />

                    @error('password_confirmation')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror
                    <button type="submit" class="btn-primary-custom w-100 mt-3">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
