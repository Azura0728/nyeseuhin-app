<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Outlet;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $user = auth()->user();

    $query = Member::query();

        if ($user->role == 'kasir') {

            $query->where(
                'outlet_id',
                $user->outlet_id
            );
        }

        if (
            $user->role != 'kasir' &&
            $request->outlet_id
        ) {
            $query->where(
                'outlet_id',
                $request->outlet_id
            );
        }

        if ($request->keyword) {

            $query->where(
                'nama',
                'like',
                '%'.$request->keyword.'%'
            );
        }

    $members = $query->get();

    $outlets = \App\Models\Outlet::all();

    return view(
        'member.index',
        compact(
            'members',
            'outlets'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $outlets = Outlet::all();

    return view(
        'member.create',
        compact('outlets')
    );
    

     $user = auth()->user();

    if ($user->role == 'kasir') {

        $outlets = \App\Models\Outlet::where(
            'id',
            $user->outlet_id
        )->get();

    } else {

        $outlets = \App\Models\Outlet::all();

    }

    return view(
        'member.create',
        compact('outlets')
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Member::create([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no_telp' => $request->no_telp,
    'outlet_id' => $request->outlet_id,
]);

    return redirect('/member');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $member = \App\Models\Member::find($id);
        if (
    auth()->user()->role == 'kasir' &&
    $member->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}
        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $member = Member::findOrFail($id);

    if (
        auth()->user()->role == 'kasir' &&
        $member->outlet_id != auth()->user()->outlet_id
    ) {
        abort(403);
    }

    $user = auth()->user();

    if ($user->role == 'kasir') {

        $outlets = \App\Models\Outlet::where(
            'id',
            $user->outlet_id
        )->get();

    } else {

        $outlets = \App\Models\Outlet::all();

    }

    return view(
        'member.edit',
        compact(
            'member',
            'outlets'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $member = Member::findOrFail($id);

    if (
        auth()->user()->role == 'kasir' &&
        $member->outlet_id != auth()->user()->outlet_id
    ) {
        abort(403);
    }

if (
    auth()->user()->role == 'kasir' &&
    $request->outlet_id != auth()->user()->outlet_id
) {
    abort(403);
}

$member->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no_telp' => $request->no_telp,
    'outlet_id' => $request->outlet_id,
]);
    

    return redirect('/member');
}

    public function destroy(string $id)
{
    $member = Member::findOrFail($id);

    if (
        auth()->user()->role == 'kasir' &&
        $member->outlet_id != auth()->user()->outlet_id
    ) {
        abort(403);
    }

    $member->delete();

    return back();
    }
}