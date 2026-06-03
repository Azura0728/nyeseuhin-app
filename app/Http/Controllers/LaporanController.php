<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with([
            'member',
            'user'
        ]);

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween(
            'tgl',
            [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]
        );

        if($request->status){
            $query->where('status',$request->status
        );

}
        }

        $transaksi = $query
            ->latest()
            ->paginate(10);

        $totalPendapatan = $transaksi->sum('total');

        return view(
            'laporan.index',
            compact(
                'transaksi',
                'totalPendapatan'
            )
        );
    }
}
