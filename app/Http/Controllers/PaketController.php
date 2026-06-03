<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        // gunakan outlet pertama sebagai default jika tidak memilih outlet pada form
        $outlet = Outlet::first();
        if (! $outlet) {
            return redirect()->back()->with('error', 'Belum ada outlet. Tambahkan outlet terlebih dahulu.');
        }

        $harga = str_replace(['Rp. ', '.'], '', $request->harga);

        Paket::create([
            'outlet_id' => $outlet->id,
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $harga,
        ]);

        return redirect()->route('paket.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paket = Paket::findOrFail($id);
        return view('paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = Paket::findOrFail($id);
        $outlets = Outlet::all();

        return view('paket.edit', compact('paket', 'outlets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'nama_paket' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        $paket = Paket::findOrFail($id);

        $harga = str_replace(['Rp. ', '.'], '', $request->harga);

        $paket->update([
            'outlet_id' => $request->outlet_id,
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $harga,
        ]);

        return redirect()->route('paket.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);

        $paket->delete();

        return redirect()->route('paket.index')
            ->with('success', 'Data berhasil dihapus');
    }
}