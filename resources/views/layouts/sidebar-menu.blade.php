<ul class="nav flex-column">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('outlet.index') }}" class="nav-link {{ request()->routeIs('outlet.*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-shop"></i> Outlet
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('paket.index') }}" class="nav-link {{ request()->routeIs('paket.*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-box"></i> Paket
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('member.index') }}" class="nav-link {{ request()->routeIs('member.*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-users"></i> Member
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('pengguna.index') }}" class="nav-link {{ request()->routeIs('pengguna.*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-user"></i> Pengguna
        </a>
    </li>

    <li class="nav-item">
        <a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-money-bill"></i> Transaksi
        </a>
    </li>

    <li class="nav-item">
        <a href="/laporan" class="nav-link {{ request()->is('laporan*') ? 'active fw-bold' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Laporan
        </a>
    </li>
</ul>
