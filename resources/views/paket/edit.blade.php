@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Paket</h2>
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

            <form action="{{ route('paket.update', $paket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="outlet_id" value="{{ $paket->outlet_id }}">
               
                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="form-control" required>
                </div>
               
                <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" value="{{ $paket->jenis }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" 
                           name="harga" 
                           id="harga"
                           class="form-control"
                           value="Rp. {{ number_format($paket->harga, 0, ',', '.') }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection