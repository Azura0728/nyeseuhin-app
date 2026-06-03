<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOutlet = Outlet::count();
        $totalPaket = Paket::count();
        $totalUser = User::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total');

        $transaksiTerbaru = Transaksi::with([
            'user',
            'details.paket'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view('dashboard', compact(
            'totalOutlet',
            'totalPaket',
            'totalUser',
            'totalTransaksi',
            'transaksiTerbaru'
        ));
    }
}