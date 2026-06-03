@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Data Paket</h2>
        <a href="{{ route('paket.create') }}" class="btn btn-primary">Tambah Paket</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Id Paket</th>
                        <th>Id Outlet</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakets as $p)
                        <tr>
                            <td>{{ $p->nama_paket }}</td>
                            <td>{{ $p->formatted_id }}</td>
                            <td>{{ $p->formatted_outlet_id }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>Rp. {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('paket.edit', $p->id) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fas fa-pen-to-square me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('paket.destroy', $p->id) }}" method="POST" class="d-inline">
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
                            <td colspan="6" class="text-center">Belum ada data paket</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    const hargaInput = document.getElementById('harga');

    hargaInput.addEventListener('keyup', function(e) {
        let angka = this.value.replace(/[^,\d]/g, '').toString();
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        this.value = 'Rp. ' + rupiah;
    });
</script>

@endsection