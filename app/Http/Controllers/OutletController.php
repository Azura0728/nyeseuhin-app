<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::all();
        return view('outlet.index', compact('outlets'));
    }

    public function create()
    {
        return view('outlet.create');
    }

    public function store(Request $request)
  {
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required'
    ]);

    Outlet::create($request->all());

    return redirect()->route('outlet.index')
        ->with('success', 'Data berhasil ditambahkan');
}

    public function show($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('outlet.show', compact('outlet'));
    }

    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('outlet.edit', compact('outlet'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required'
    ]);

    $outlet = Outlet::findOrFail($id);
    $outlet->update($request->all());

    return redirect()->route('outlet.index')
        ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return redirect()->route('outlet.index');
    }
}