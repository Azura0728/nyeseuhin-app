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
    $user = auth()->user();

    if ($user->role == 'kasir') {

        $members = Member::where(
            'outlet_id',
            $user->outlet_id
        )->get();

    } else {

        $members = Member::all();

    }

    $pakets = Paket::all();

    return view(
        'transaksi.create',
        compact(
            'members',
            'pakets'
        )
    );
}

public function store(Request $request)
{
    DB::beginTransaction();

    try {

    $member = Member::findOrFail(
    $request->member_id
);

if (
    auth()->user()->role == 'kasir' &&
    $member->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}

        // ambil paket
        $paket = Paket::findOrFail($request->paket_id);

        // hitung subtotal
        $subtotal = $paket->harga * $request->qty;

        // simpan transaksi
        $transaksi = Transaksi::create([
            'member_id' => $request->member_id,
            'user_id' => auth()->id(),
            'outlet_id' => auth()->user()->outlet_id,
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

public function index(Request $request)
{
    $user = auth()->user();

    $query = Transaksi::with([
        'member',
        'user'
    ]);

    // Kasir hanya melihat transaksi outlet sendiri
    if ($user->role == 'kasir') {

        $query->whereHas(
            'member',
            function ($q) use ($user) {

                $q->where(
                    'outlet_id',
                    $user->outlet_id
                );

            }
        );
    }

    // Filter outlet untuk admin/super admin
    if (
        $user->role != 'kasir' &&
        $request->outlet_id
    ) {

        $query->whereHas(
            'member',
            function ($q) use ($request) {

                $q->where(
                    'outlet_id',
                    $request->outlet_id
                );

            }
        );
    }

    // Search nama member
    if ($request->keyword) {

        $query->whereHas(
            'member',
            function ($q) use ($request) {

                $q->where(
                    'nama',
                    'like',
                    '%'.$request->keyword.'%'
                );

            }
        );
    }

    // Filter status
    if ($request->status) {

        $query->where(
            'status',
            $request->status
        );
    }

    $transaksis = $query
        ->latest()
        ->get();

    $outlets = \App\Models\Outlet::all();

    return view(
        'transaksi.index',
        compact(
            'transaksis',
            'outlets'
        )
    );
}

public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);

    if (
    auth()->user()->role == 'kasir' &&
    $transaksi->member->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}

    $user = auth()->user();

if (
    $user->role == 'kasir' &&
    $transaksi->member->outlet_id != $user->outlet_id
) {
    abort(403);
}

    $user = auth()->user();

    if ($user->role == 'kasir') {

        $members = Member::where(
            'outlet_id',
            $user->outlet_id
        )->get();

    } else {

        $members = Member::all();

    }

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

    if (
    auth()->user()->role == 'kasir' &&
    $transaksi->member->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}

    $user = auth()->user();

if (
    $user->role == 'kasir' &&
    $transaksi->member->outlet_id != $user->outlet_id
) {
    abort(403);
}

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

    if (
    auth()->user()->role == 'kasir' &&
    $transaksi->member->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}

    $user = auth()->user();

if (
    $user->role == 'kasir' &&
    $transaksi->member->outlet_id != $user->outlet_id
) {
    abort(403);
}

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
