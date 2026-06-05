@extends('layouts.app')

@section('content')

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <h4>
            Selamat Datang,
            {{ $user->name }}
        </h4>

        <p>
            Role:
            <strong>
                {{ ucfirst($user->role) }}
            </strong>
        </p>

    </div>

</div>

@if($user->role == 'kasir')

<div class="card border-primary mb-4">

    <div class="card-body">

        <h5>
            Outlet Penempatan
        </h5>

        <h3>
            {{ $user->outlet->nama ?? 'Belum ditentukan' }}
        </h3>

    </div>
</div>

@endif

<h2 class="fw-bold mb-4">
    Dashboard
</h2>


@if($user->role != 'kasir')
<div class="row g-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h6>Total Transaksi</h6>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <h6>Total Paket</h6>
                <h2>{{ $totalPaket }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
                <h6>Total Outlet</h6>
                <h2>{{ $totalOutlet }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
                <h6>Total Member</h6>
                <h2>{{ $totalUser }}</h2>
            </div>
        </div>
    </div>

</div>
@endif

@if($user->role == 'kasir')

<div class="row g-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h6>Total Member</h6>
                <h2>{{ $totalMember }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <h6>Total Transaksi</h6>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
                <h6>Pendapatan Outlet</h6>
                <h5>
                    Rp {{ number_format($totalPendapatan,0,',','.') }}
                </h5>
            </div>
        </div>
    </div>

</div>

@endif

<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-white">
        <strong>Transaksi Terbaru</strong>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>Kasir</th>
                <th>Paket</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
            </thead>

            <tbody>

@forelse($transaksiTerbaru as $trx)

<tr>

    <td>{{ $trx->id }}</td>

    <td>{{ $trx->member->nama }}</td>

    <td>
        {{ $trx->user->name ?? '-' }}
    </td>

    <td>
        <span class="badge bg-info">
            {{ $trx->details->first()?->paket?->nama_paket ?? '-' }}
        </span>
    </td>

    <td>

        @if($trx->status == 'baru')
            <span class="badge bg-secondary">Baru</span>
        @elseif($trx->status == 'proses')
            <span class="badge bg-warning">Proses</span>
        @elseif($trx->status == 'selesai')
            <span class="badge bg-success">Selesai</span>
        @else
            <span class="badge bg-primary">Diambil</span>
        @endif

    </td>

    <td>
        Rp {{ number_format($trx->total,0,',','.') }}
    </td>

</tr>

@empty

<tr>
    <td colspan="5" class="text-center">
        Belum ada transaksi
    </td>
</tr>

@endforelse

</tbody>

        </table>

    </div>

</div>



@endsection