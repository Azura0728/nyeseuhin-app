@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-sm border-0 p-4" style="width: 380px; border-radius: 12px;">

        {{-- LOGO --}}
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.jpeg') }}"
                 style="width: 100px;">
            <h5 class="mt-2 fw-semibold">Register</h5>
        </div>

        {{-- FORM REGISTER --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAME --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>

            {{-- BUTTON --}}
            <button class="btn btn-primary w-100">
                Register
            </button>

            {{-- BACK TO LOGIN --}}
            <div class="text-center mt-3">
                <small class="text-muted">Sudah punya akun?</small><br>
                <a href="{{ route('login') }}" class="btn btn-link p-0">
                    Login di sini
                </a>
            </div>

        </form>

    </div>
</div>
@endsection