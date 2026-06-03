@extends('layouts.app')

@section('content')

<h2 class="fw-bold mb-4">
    Dashboard
</h2>

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
                <h6>Total Pengguna</h6>
                <h2>{{ $totalUser }}</h2>
            </div>
        </div>
    </div>

</div>

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