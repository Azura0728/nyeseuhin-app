<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Paket;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{

public function create()
{
    $members = Member::all();
    $pakets = Paket::all();

    return view('transaksi.create', compact(
        'members',
        'pakets'
    ));
}
public function store(Request $request)
{
    DB::beginTransaction();

    try {

        // ambil paket
        $paket = Paket::findOrFail($request->paket_id);

        // hitung subtotal
        $subtotal = $paket->harga * $request->qty;

        // simpan transaksi
        $transaksi = Transaksi::create([
            'member_id' => $request->member_id,
            'user_id' => auth()->id(),
            'tgl' => now(),
            'batas_waktu' => now()->addDays(3),
            'total' => $subtotal,
            'status' => 'baru',
            'dibayar' => 'belum_dibayar'
        ]);

        // simpan detail transaksi
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'paket_id' => $request->paket_id,
            'qty' => $request->qty,
            'subtotal' => $subtotal
        ]);

        DB::commit();

        return redirect()->route('transaksi.index');

    } catch (\Exception $e){

        DB::rollback();

        return $e->getMessage();
    }
}
public function index()
{
    $transaksis = Transaksi::with('member')->get();

    return view('transaksi.index', compact(
        'transaksis'
    ));
}

public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $members = Member::all();
    $pakets = Paket::all();

    return view(
        'transaksi.edit',
        compact(
            'transaksi',
            'members',
            'pakets'
        )
    );
}

public function update(Request $request, $id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->update([

        'member_id' => $request->member_id,

        'status' => $request->status,

        'dibayar' => $request->dibayar

    ]);

    return redirect()
        ->route('transaksi.index')
        ->with('success','Transaksi berhasil diupdate');
}

public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);

    DetailTransaksi::where(
        'transaksi_id',
        $transaksi->id
    )->delete();

    $transaksi->delete();

    return redirect()
        ->route('transaksi.index')
        ->with('success','Transaksi berhasil dihapus');
}
}
