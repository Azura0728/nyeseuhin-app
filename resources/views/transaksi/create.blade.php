@extends('layouts.app')

@section('content')

<!-- TOPBAR -->
<div class="topbar">

    <div>
        <h2>Tambah Transaksi</h2>
    </div>

</div>

<!-- CARD -->
<div class="card-box">

    <form action="{{ route('transaksi.store') }}"
    method="POST">

        @csrf

        <!-- MEMBER -->
        <div class="mb-3">

            <label>Member</label>

            <select name="member_id"
            class="form-control">

                @foreach($members as $m)

                    <option value="{{ $m->id }}">
                        {{ $m->nama }}
                    </option>

                @endforeach

            </select>

        </div>

        <!-- PAKET -->
        <div class="mb-3">

            <label>Paket</label>

            <select name="paket_id"
            class="form-control">

                @foreach($pakets as $p)

                    <option value="{{ $p->id }}">
                        {{ $p->nama_paket }}
                    </option>

                @endforeach

            </select>

        </div>

        <!-- QTY -->
        <div class="mb-3">

            <label>Qty</label>

            <input type="number"
            name="qty"
            class="form-control">

        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('transaksi.index') }}"
        class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection