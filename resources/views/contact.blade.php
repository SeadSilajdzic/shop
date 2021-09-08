@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between mx-3 pt-5">
            <div class="card-custom col-md-5 mb-5 m-md-0">
                <h2>Location</h2>
                <p class="mb-4">
                    <i class="fas fa-map-marker-alt"></i>
                    Belgrade, Mali Mokri Lug
                </p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.8982444276176!2d20.415941315711155!3d44.78287978666524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a6fd0128a5345%3A0xe0b892b1f6b40785!2z0JPQuNCz0LDRgtGA0L7QvQ!5e0!3m2!1ssr!2srs!4v1605818473863!5m2!1ssr!2srs"
                    frameborder="0" style="border: 0" class="mr-5 w-100" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="card-custom col-md-5 contact-form ">
                <h2>Contact</h2>
                <form method="POST" action="{{ route('contactUs') }}">
                    @csrf
                    <label for="name">Name</label>
                    <input id="name" type="name" name="name" class="input-custom" />

                    @error('name')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" class="input-custom" />

                    @error('email')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <label for="message">Message</label>
                    <textarea rows="3" id="message" class="input-custom" name="message"></textarea>

                    @error('message')
                        <p class="text-danger mb-3 auth-error">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="mt-4">
                        <button class="btn-primary-custom" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
