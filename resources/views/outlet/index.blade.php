@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">
        Data Outlet
    </h2>

    <a href="{{ route('outlet.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus me-1"></i>
        Tambah Outlet

    </a>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-light">

                <tr>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th width="180">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($outlets as $o)

                <tr>

                    <td>{{ $o->nama }}</td>

                    <td>{{ $o->alamat }}</td>

                    <td>{{ $o->no_telp }}</td>

                    <td>

                        <a href="{{ route('outlet.edit', $o->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-pen-to-square me-1"></i>
                            Edit

                        </a>

                        <form action="{{ route('outlet.destroy', $o->id) }}"
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

                    <td colspan="4" class="text-center text-muted">
                        Belum ada data outlet
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</div>

@endsection
