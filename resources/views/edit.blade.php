<form method="POST" action="/member/{{ $member->id }}">
@csrf
@method('PUT')

<input type="text" name="nama" value="{{ $member->nama }}">
<input type="text" name="alamat" value="{{ $member->alamat }}">
<input type="text" name="no_telp" value="{{ $member->no_telp }}">

<button type="submit">Update</button>
</form>