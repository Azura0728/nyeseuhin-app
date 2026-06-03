<h1 class="fw-bold">Data Member</h1>

<a href="/member/create">Tambah</a>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No Telp</th>
    <th>Aksi</th>
</tr>

@foreach($members as $m)
<tr>
    <td>{{ $m->nama }}</td>
    <td>{{ $m->alamat }}</td>
    <td>{{ $m->no_telp }}</td>
    <td>
        <a href="/member/{{ $m->id }}/edit">Edit</a>

        <form action="/member/{{ $m->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>