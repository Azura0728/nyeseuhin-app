@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Member</h2>
        <a href="{{ route('member.index') }}" class="btn btn-secondary">Kembali</a>
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

            <form action="{{ route('member.update', $member->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $member->nama }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $member->alamat }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $member->no_telp }}" required>
                </div>
                <div class="mb-3">

    <label class="form-label">
        Outlet
    </label>

    <select
        name="outlet_id"
        class="form-control"
        required>

        @foreach($outlets as $outlet)

            <option
                value="{{ $outlet->id }}"
                {{ $member->outlet_id == $outlet->id ? 'selected' : '' }}>

                {{ $outlet->nama }}

            </option>

        @endforeach

    </select>

</div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('member.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection