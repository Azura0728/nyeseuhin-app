@extends('layouts.app')

@section('content')

<!-- TOPBAR -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">Data Transaksi</h2>
    </div>

    <div>
        <a href="{{ route('transaksi.create') }}"
        class="btn btn-primary">
            Tambah Transaksi
        </a>
    </div>

</div>

<!-- CARD -->
<div class="card shadow-sm border-0">
    <div class="card-body">
<form method="GET" class="mb-3">

    <div class="row">

        <div class="col-md-4">

            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Cari nama member..."
                value="{{ request('keyword') }}">

        </div>

        <div class="col-md-3">

            <select
                name="status"
                class="form-control">

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

            <select
                name="outlet_id"
                class="form-control">

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

        <div class="col-md-2">

            <button
                class="btn btn-primary w-100">

                Cari

            </button>

        </div>

    </div>

</form>
    <table class="table table-bordered align-middle">

        <thead>
            <tr>
                <th>Member</th>
                <th>Total</th>
                <th>Status</th>
                <th>Dibayar</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach($transaksis as $t)

            <tr>

                <td>{{ $t->member->nama }}</td>

                <td>
                    Rp {{ number_format($t->total) }}
                </td>

                <td>

                    @if($t->status == 'baru')
                        <span class="badge bg-secondary">Baru</span>

                    @elseif($t->status == 'proses')
                        <span class="badge bg-warning">Proses</span>

                    @elseif($t->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>

                    @else
                        <span class="badge bg-primary">Diambil</span>
                    @endif
                </td>

                <td>

                    @if($t->dibayar == 'dibayar')

                        <span class="badge bg-success">
                            Dibayar
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Belum Dibayar
                        </span>

                    @endif

                </td>

                <td class="text-nowrap">

                    <a href="{{ route('transaksi.edit', $t->id) }}"
                    class="btn btn-warning btn-sm">

                        <i class="fas fa-pen-to-square me-1"></i>
                        Edit

                    </a>

                    <form
                        action="{{ route('transaksi.destroy', $t->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="btn btn-danger btn-sm btn-delete">

                            <i class="fas fa-trash me-1"></i>
                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
</div>
</div>
@endsection