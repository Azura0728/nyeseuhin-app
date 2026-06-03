<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

Route::resource('pengguna', UserController::class)
    ->parameters([
        'pengguna' => 'user'
    ]);

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::get('/laporan', [
        LaporanController::class,
        'index'
    ])->name('laporan.index');

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});

Route::middleware(['auth','kasir'])->group(function () {

    Route::resource(
        'member',
        MemberController::class
    );

    Route::resource(
        'transaksi',
        TransaksiController::class
    );

});

Route::middleware(['auth','admin'])->group(function(){

    Route::resource('outlet', OutletController::class);

    Route::resource('paket', PaketController::class);

    Route::resource('pengguna', UserController::class);

});



require __DIR__.'/auth.php';
