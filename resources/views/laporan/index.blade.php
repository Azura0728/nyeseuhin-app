@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Laporan Transaksi</h2>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            {{-- FILTER --}}
            <form method="GET">

                <div class="row g-3 mb-4">

                    <div class="col-md-3">
                        <label class="form-label">
                            Tanggal Awal
                        </label>

                        <input
                            type="date"
                            name="tanggal_awal"
                            value="{{ request('tanggal_awal') }}"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Tanggal Akhir
                        </label>

                        <input
                            type="date"
                            name="tanggal_akhir"
                            value="{{ request('tanggal_akhir') }}"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="baru"
                                {{ request('status') == 'baru' ? 'selected' : '' }}>
                                Baru
                            </option>

                            <option value="proses"
                                {{ request('status') == 'proses' ? 'selected' : '' }}>
                                Proses
                            </option>

                            <option value="selesai"
                                {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="diambil"
                                {{ request('status') == 'diambil' ? 'selected' : '' }}>
                                Diambil
                            </option>

                        </select>
                    </div>

                    @if(auth()->user()->role != 'kasir')

                    <div class="col-md-3">

                        <label class="form-label">
                            Outlet
                        </label>

                        <select
                            name="outlet_id"
                            class="form-select">

                            <option value="">
                                Semua Outlet
                            </option>

                            @foreach($outlets as $outlet)

                            <option
                                value="{{ $outlet->id }}"
                                {{ request('outlet_id') == $outlet->id ? 'selected' : '' }}>

                                {{ $outlet->nama }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    @endif

                    <div class="col-md-3 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="fas fa-filter me-2"></i>
                            Filter

                        </button>

                    </div>

                </div>

            </form>

            {{-- RINGKASAN --}}
            <div class="row mb-4">

                <div class="col-md-6">

                    <div class="card bg-primary text-white border-0">

                        <div class="card-body">

                            <h6>Total Pendapatan</h6>

                            <h3>
                                Rp {{ number_format($totalPendapatan ?? 0,0,',','.') }}
                            </h3>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card bg-success text-white border-0">

                        <div class="card-body">

                            <h6>Total Transaksi</h6>

                            <h3>
                                {{ $transaksi->count() }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

            {{-- TABEL --}}
            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-light">

                        <tr>
                            <th width="70">No</th>
                            <th>Tanggal</th>
                            <th>Member</th>
                            <th>Kasir</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($transaksi as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->created_at->format('d-m-Y') }}</td>

                            <td>{{ $item->member->nama ?? '-' }}</td>

                            <td>{{ $item->user->name ?? '-' }}</td>

                            <td>

                                @if($item->status == 'baru')
                                    <span class="badge bg-secondary">Baru</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge bg-warning">Proses</span>
                                @elseif($item->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-info">
                                        {{ $item->status }}
                                    </span>
                                @endif

                            </td>

                            <td>
                                Rp {{ number_format($item->total,0,',','.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-4">
                                Belum ada data transaksi
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection