@extends('layouts.app')

@section('content')

<h2 class="fw-bold">Data Pengguna</h2>

@if(Auth::user()->isSuperAdmin())
    <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">Tambah Pengguna</a>
@else
    <div class="alert alert-info mb-3">
        Anda hanya bisa edit data diri sendiri sebagai admin biasa.
    </div>
@endif

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Super</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'owner' ? 'success' : 'warning') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td>
                @if($user->is_super_admin)
                    <span class="badge bg-danger">Super Admin</span>
                @else
                    <span class="badge bg-secondary">Biasa</span>
                @endif
            </td>
            
            <td>
                @if(Auth::user()->isSuperAdmin() || Auth::user()->id == $user->id)
                    <a href="{{ route('pengguna.edit', $user->id) }}"
                    class="btn btn-warning btn-sm">

                        <i class="fas fa-pen-to-square me-1"></i>
                        Edit

                    </a>
                @endif
                
                @if(Auth::user()->isSuperAdmin() && Auth::user()->id != $user->id)
                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-danger btn-sm btn-delete">

                            <i class="fas fa-trash me-1"></i>
                            Hapus

                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection