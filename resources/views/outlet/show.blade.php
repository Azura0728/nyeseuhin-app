@extends('layouts.app')

@section('content')


<h2 class="mb-4">
    Detail Outlet
</h2>

<div class="card mb-4">
    <div class="card-body">

        <h3>{{ $outlet->nama }}</h3>

        <p>
            <strong>Alamat :</strong>
            {{ $outlet->alamat }}
        </p>

        <p>
            <strong>No Telp :</strong>
            {{ $outlet->no_telp }}
        </p>

    </div>
</div>

<div class="row">

    <div class="col-md-3">

        <div class="card text-center">
            <div class="card text-center bg-primary text-white">

                <h6>Kasir</h6>

                <h2>
                    {{ $outlet->users->count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">
            <div class="card text-center bg-success text-white">

                <h6>Member</h6>

                <h2>
                    {{ $outlet->members->count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">
            <div class="card text-center bg-warning">

                <h6>Transaksi</h6>

                <h2>
                    {{ $outlet->transaksis->count() }}
                </h2>

            </div>
        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">
            <div class="card text-center bg-danger text-white">

                <h6>Pendapatan</h6>

                <h5>
                    Rp {{ number_format($totalPendapatan,0,',','.') }}
                </h5>

            </div>
        </div>

    </div>

</div>

<hr>

<h4>Kasir Outlet</h4>


<table class="table table-bordered">

    <thead>
        <tr>
            <th>Nama</th>
            <th>Role</th>
        </tr>
    </thead>

    <tbody>

        @foreach($outlet->users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>

        @endforeach


    </tbody>

</table>

<hr>

<h4>Member Outlet</h4>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Alamat</th>
        </tr>
    </thead>

    <tbody>

        @forelse($outlet->members as $member)

        <tr>
            <td>{{ $member->nama }}</td>
            <td>{{ $member->no_telp }}</td>
            <td>{{ $member->alamat }}</td>
        </tr>

        @empty

        <tr>
            <td colspan="3" class="text-center">
                Belum ada member
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<a href="{{ route('outlet.index') }}"
   class="btn btn-outline-secondary">
    <i class="fas fa-arrow-left me-1"></i>
    Kembali
</a>

@endsection