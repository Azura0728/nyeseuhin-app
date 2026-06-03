<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $members = \App\Models\Member::all();
    return view('member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           \App\Models\Member::create($request->all());
            return redirect('/member');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $member = \App\Models\Member::find($id);
        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = \App\Models\Member::find($id);
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = \App\Models\Member::find($id);
        $member->update($request->all());
        return redirect('/member');
    }

    public function destroy(string $id)
    {
        \App\Models\Member::destroy($id);
        return back();
    }
}