<!DOCTYPE html>
<html>
<head>
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="background-color:#f8f9fa;">

<!-- TOP NAVIGATION BAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <!-- Logo dihapus dari sini -->

        <div class="d-flex align-items-center">
            <div class="">
                <div class="fw-bold">Profil</div>
                <small class="text-muted">{{ Auth::user()->name ?? 'Guest' }}</small>
            </div>
        </div>
    </div>
</nav>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div style="width:220px; background:white; min-height:100vh; border-right:1px solid #ddd;">
        <div class="p-3">
            <!-- LOGO -->
            <div class="text-center">
                        <img src="{{ asset('images/logo.jpeg') }}" width="90">
            </div>

            <hr>

            @include('layouts.sidebar-menu')

            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
    </div>

<style>
.nav-link i {
    margin-right: 10px;
    width: 20px;
}
.nav-link.active {
    background-color: #f8f9fa;
    border-radius: 5px;
}
</style>

    <!-- CONTENT -->
    <div class="p-4" style="width:100%;">
        @yield('content')
    </div>

</div>

</body>
</html>



@if(auth()->user()->role == 'owner')

<li>
    <a href="/outlet">Outlet</a>
</li>

<li>
    <a href="/paket">Paket</a>
</li>

<li>
    <a href="/pengguna">Pengguna</a>
</li>

@endif


@if(auth()->user()->role == 'kasir')

<li>
    <a href="/member">Member</a>
</li>

<li>
    <a href="/transaksi">Transaksi</a>
</li>

@endif