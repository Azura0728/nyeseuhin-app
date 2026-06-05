@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        Edit Transaksi
    </div>

    <div class="card-body">

        <form action="{{ route('transaksi.update',$transaksi->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Member</label>

                <select name="member_id"
                    class="form-control">

                    @foreach($members as $member)

                    <option
                        value="{{ $member->id }}"
                        {{ $member->id == $transaksi->member_id ? 'selected' : '' }}>

                        {{ $member->nama }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Status Laundry</label>

                <select
                    name="status"
                    class="form-control">

                    <option value="baru"
                    {{ $transaksi->status == 'baru' ? 'selected' : '' }}>
                        Baru
                    </option>

                    <option value="proses"
                    {{ $transaksi->status == 'proses' ? 'selected' : '' }}>
                        Proses
                    </option>

                    <option value="selesai"
                    {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="diambil"
                    {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>
                        Diambil
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>Status Pembayaran</label>

                <select
                    name="dibayar"
                    class="form-control">

                    <option value="belum_dibayar"
                    {{ $transaksi->dibayar == 'belum_dibayar' ? 'selected' : '' }}>

                        Belum Dibayar

                    </option>

                    <option value="dibayar"
                    {{ $transaksi->dibayar == 'dibayar' ? 'selected' : '' }}>

                        Dibayar

                    </option>

                </select>

            </div>

            <button class="btn btn-primary">

                Update

            </button>

        </form>

    </div>
</div>

@endsection