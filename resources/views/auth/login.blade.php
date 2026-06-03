@extends('layouts.auth')


@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-sm border-0 p-4" style="width: 380px; border-radius: 12px;">

        {{-- LOGO --}}
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.jpeg') }}"
                 style="width: 100px;">
            <h5 class="mt-2 fw-semibold">Login</h5>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

            <button class="btn btn-primary w-100 mt-3">
                Login
            </button>

            <div class="mt-3 text-center">
                <span class="text-muted">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="btn btn-link p-0 ms-1">
                    Daftar sekarang
                </a>
            </div>
        </form>

    </div>
</div>
@endsection