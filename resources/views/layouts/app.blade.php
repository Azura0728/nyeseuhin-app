<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nyeseuhin-App') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            background:#f5f6fa;
            font-family:'Figtree',sans-serif;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#fff;
            border-right:1px solid #e5e7eb;
        }

        .logo-area{
            text-align:center;
            padding:30px 20px;
        }

        .logo-area img{
            max-width:120px;
        }

        .menu-title{
            font-size:14px;
            color:#6b7280;
            padding-left:20px;
            margin-bottom:10px;
        }

        .nav-link{
            color:#374151;
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:6px;
            transition:.2s;
        }

        .nav-link:hover{
            background:#eef4ff;
            color:#0d6efd;
        }

        .nav-link.active{
            background:#e8f0ff;
            color:#0d6efd;
            font-weight:600;
        }

        .content-wrapper{
            flex:1;
        }

        .topbar{
            background:#fff;
            padding:15px 25px;
            border-bottom:1px solid #e5e7eb;
        }

        .content{
            padding:30px;
        }

        .profile-name{
            font-size:14px;
            color:#6b7280;
        }

        .logout-btn{
            margin:20px;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.body.addEventListener('click', function(e){

        const button = e.target.closest('.btn-delete');

        if(!button) return;

        e.preventDefault();

        const form = button.closest('form');

        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});
</script>
@if(session('success'))

<script>

Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});

</script>

@endif

@if(session('error'))

<script>

Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}'
});

</script>

@endif
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo-area">

            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">

            <h6 class="mt-3 mb-0 fw-bold">
                Nyeseuhin
            </h6>

            <small class="text-muted">
                Laundry Management
            </small>

        </div>

        <div class="menu-title">
            MENU UTAMA
        </div>

        <ul class="nav flex-column px-3">

    {{-- Dashboard (semua role) --}}
    <li class="nav-item">
        <a href="/dashboard"
           class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line me-2"></i>
            Dashboard
        </a>
    </li>

    {{-- ADMIN + SUPER ADMIN --}}
    @if(Auth::user()->role == 'admin' || Auth::user()->is_super_admin)

        <li class="nav-item">
            <a href="/outlet"
               class="nav-link {{ request()->is('outlet*') ? 'active' : '' }}">
                <i class="fas fa-store me-2"></i>
                Outlet
            </a>
        </li>

        <li class="nav-item">
            <a href="/paket"
               class="nav-link {{ request()->is('paket*') ? 'active' : '' }}">
                <i class="fas fa-box-open me-2"></i>
                Paket
            </a>
        </li>

        <li class="nav-item">
            <a href="/pengguna"
               class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i>
                Pengguna
            </a>
        </li>

    @endif

    {{-- KASIR + ADMIN + SUPER ADMIN --}}
    @if(
        Auth::user()->role == 'kasir' ||
        Auth::user()->role == 'admin' ||
        Auth::user()->is_super_admin
    )

        <li class="nav-item">
            <a href="/member"
               class="nav-link {{ request()->is('member*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>
                Member
            </a>
        </li>

        <li class="nav-item">
            <a href="/transaksi"
               class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave me-2"></i>
                Transaksi
            </a>
        </li>

    @endif

    {{-- SEMUA ROLE --}}
    <li class="nav-item">
        <a href="/laporan"
           class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i>
            Laporan
        </a>
    </li>

</ul>

        <div class="logout-btn">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                </button>

            </form>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">

        <div class="topbar d-flex justify-content-between align-items-center">

            <div>
                <h5 class="mb-0">
                    Profil
                </h5>

                <small class="profile-name">
                    {{ Auth::user()->name ?? 'Admin' }}
                </small>
            </div>

        </div>

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>