<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalMember = 0;
        $totalPendapatan = 0;

        if ($user->role == 'kasir') {

    $transaksiTerbaruOutlet = Transaksi::with([
        'member',
        'user'
    ])
    ->where('outlet_id', $user->outlet_id)
    ->latest()
    ->take(5)
    ->get();

} else {

    $transaksiTerbaruOutlet = Transaksi::with([
        'member',
        'user'
    ])
    ->latest()
    ->take(5)
    ->get();

}

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

        if ($user->role == 'kasir') {

    $totalMember = Member::where(
        'outlet_id',
        $user->outlet_id
    )->count();

    $totalTransaksi = Transaksi::where(
        'outlet_id',
        $user->outlet_id
    )->count();

    $totalPendapatan = Transaksi::where(
        'outlet_id',
        $user->outlet_id
    )->sum('total');
}

       return view('dashboard', compact(
            'user',
            'totalOutlet',
            'totalPaket',
            'totalUser',
            'totalTransaksi',
            'transaksiTerbaru',
            'transaksiTerbaruOutlet',
            'totalMember',
            'totalPendapatan',
            
        ));

      
        
    }
}