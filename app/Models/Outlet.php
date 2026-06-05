<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function members()
{
    return $this->hasMany(Member::class);
}

public function transaksis()
{
    return $this->hasMany(Transaksi::class);
}

}

