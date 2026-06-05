<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Outlet;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $outlets = Outlet::all();

        $query = Transaksi::with([
            'member',
            'user'
        ]);

        // Kasir hanya melihat transaksi outletnya sendiri
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

        // Filter outlet untuk admin / super admin
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

        // Filter tanggal
        if (
            $request->tanggal_awal &&
            $request->tanggal_akhir
        ) {

            $query->whereBetween(
                'tgl',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );

        }

        // Filter status
        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );

        }

        $transaksi = $query
            ->latest()
            ->paginate(10);

        // Clone query supaya tidak bentrok dengan paginate
        $totalPendapatan = (clone $query)->sum('total');

        return view(
            'laporan.index',
            compact(
                'transaksi',
                'totalPendapatan',
                'outlets'
            )
        );
    }
}