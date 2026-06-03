@extends('layouts.app')

@section('content')



<h2>Edit Pengguna</h2>

<form action="{{ route('pengguna.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    @if(!(Auth::id() == $user->id && $user->is_super_admin))

<div class="mb-3">
    <label for="role" class="form-label">Role</label>

    <select class="form-control" id="role" name="role" required>
        <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
    </select>

</div>

@else

<div class="mb-3">
    <label class="form-label">Role</label>
    <input
        type="text"
        class="form-control"
        value="{{ ucfirst($user->role) }}"
        readonly>
</div>

@endif

    @if(Auth::user()->isSuperAdmin())
    <div class="mb-3 form-check">
        <label class="form-check-label" for="is_super_admin">
            Super Admin (Bisa manage admin lain)
        </label>
    </div>
    @endif

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection