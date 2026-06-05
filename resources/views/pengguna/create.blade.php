@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2>Tambah Pengguna</h2>

<form action="{{ route('pengguna.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option value="kasir">Kasir</option>
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
        </select>
    </div>

    <div
    class="mb-3"
    id="outlet-wrapper">

    <label>Outlet</label>

    <select
        name="outlet_id"
        class="form-control">

        <option value="">
            Pilih Outlet
        </option>

        @foreach($outlets as $outlet)

        <option value="{{ $outlet->id }}">
            {{ $outlet->nama }}
        </option>

        @endforeach

    </select>

</div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_super_admin" name="is_super_admin" value="1">
        <label class="form-check-label" for="is_super_admin">
            Super Admin (Bisa manage admin lain)
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
</form>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const role =
            document.getElementById('role');

        const outlet =
            document.getElementById(
                'outlet-wrapper'
            );

        function toggleOutlet() {

            if (
                role.value == 'kasir'
            ) {

                outlet.style.display =
                    'block';

            } else {

                outlet.style.display =
                    'none';

            }

        }

        toggleOutlet();

        role.addEventListener(
            'change',
            toggleOutlet
        );

    }
);

</script>

@endsection