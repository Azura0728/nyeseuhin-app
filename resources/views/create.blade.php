<form method="POST" action="/member">
@csrf

<input type="text" name="nama" placeholder="Nama">
<input type="text" name="alamat" placeholder="Alamat">
<input type="text" name="no_telp" placeholder="No Telp">

<button type="submit">Simpan</button>
</form>