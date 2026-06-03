<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    if (
        !$user->isSuperAdmin() &&
        $user->role != 'admin'
    ) {
        abort(403);
    }

    $users = User::all();

    return view('pengguna.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya Super Admin yang bisa menambah user
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('pengguna.index')->with('error', 'Anda tidak memiliki izin untuk menambah user');
        }
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hanya Super Admin yang bisa membuat user
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('pengguna.index')->with('error', 'Anda tidak memiliki izin untuk menambah user');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,owner,kasir',
            'is_super_admin' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_super_admin' => $request->is_super_admin ?? false,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pengguna.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Super Admin bisa edit siapa saja
        // Admin biasa hanya bisa edit dirinya sendiri
        $currentUser = Auth::user();
        
        if (!$currentUser->isSuperAdmin() && $currentUser->id != $user->id) {
            return redirect()->route('pengguna.index')->with('error', 'Anda hanya bisa edit data diri sendiri');
        }
        
        return view('pengguna.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Super Admin bisa edit siapa saja
        // Admin biasa hanya bisa edit dirinya sendiri
        $currentUser = Auth::user();
        
        if (!$currentUser->isSuperAdmin() && $currentUser->id != $user->id) {
            return redirect()->route('pengguna.index')->with('error', 'Anda hanya bisa edit data diri sendiri');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,owner,kasir',
            'is_super_admin' => 'boolean',
        ]);

        if (
    $user->id == auth()->id() &&
    $user->is_super_admin &&
    $request->role != $user->role
) {
    return back()->with(
        'error',
        'Role Super Admin tidak dapat diubah.'
    );
}

        if (
    $user->id == auth()->id()
    && $user->is_super_admin
) {

    if (
    $user->is_super_admin &&
    !$request->has('is_super_admin')
) {

    $jumlahSuperAdmin = User::where(
        'is_super_admin',
        true
    )->count();

    if ($jumlahSuperAdmin <= 1) {

        return back()->with(
            'error',
            'Minimal harus ada 1 Super Admin.'
        );

    }
}

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

} else {

    $data = [
    'name' => $request->name,
    'email' => $request->email,
];

if (
    !($user->id == auth()->id() &&
      $user->is_super_admin)
) {
    $data['role'] = $request->role;
}

$user->update($data);

}

        // Hanya Super Admin yang bisa ubah status super admin
        if ($currentUser->isSuperAdmin()) {
            $user->update(['is_super_admin' => $request->is_super_admin ?? false]);
        }

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('pengguna.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        // Hanya Super Admin yang bisa hapus user
        if (!$currentUser->isSuperAdmin()) {
            return redirect()->route('pengguna.index')->with('error', 'Anda tidak memiliki izin untuk hapus user');
        }

        // Super Admin tidak bisa menghapus dirinya sendiri
        if ($currentUser->id == $user->id) {
            return redirect()->route('pengguna.index')->with('error', 'Anda tidak bisa menghapus diri sendiri');
        }

        if ($user->is_super_admin) {

    $jumlahSuperAdmin = User::where(
        'is_super_admin',
        true
    )->count();

    if ($jumlahSuperAdmin <= 1) {

        return back()->with(
            'error',
            'Minimal harus ada 1 Super Admin.'
        );

    }
}

        $user->delete();
        return redirect()->route('pengguna.index')->with('success', 'User berhasil dihapus');
    }

    
}
