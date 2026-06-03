@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tambah Paket</h2>
        <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('paket.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" class="form-control" placeholder="Masukkan nama paket" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" value="{{ old('jenis') }}" class="form-control" placeholder="Masukkan jenis paket" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text"
                           name="harga"
                           id="harga"
                           class="form-control"
                           value="{{ old('harga') }}"
                           placeholder="Masukkan harga paket" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection