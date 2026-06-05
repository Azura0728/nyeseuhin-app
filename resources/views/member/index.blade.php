@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">
        Data Member
    </h2>

    <a href="{{ route('member.create') }}"
       class="btn btn-primary">
        Tambah Member
    </a>

</div>




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

        @if(auth()->user()->role != 'kasir')

        <div class="col-md-4">

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

        <table class="table table-hover table-bordered">

            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($members as $m)

                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->alamat }}</td>
                    <td>{{ $m->no_telp }}</td>

                    <td>

                        <a href="{{ route('member.edit', $m->id) }}"
                            class="btn btn-warning btn-sm">

                                <i class="fas fa-pen-to-square me-1"></i>
                                Edit

                            </a>

                        <form action="{{ route('member.destroy', $m->id) }}"
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

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada data member
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection