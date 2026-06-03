<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
    'member_id',
    'user_id',
    'tgl',
    'batas_waktu',
    'total',
    'status',
    'dibayar'
    ];
    public function member()
{
    return $this->belongsTo(Member::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function details()
{
    return $this->hasMany(DetailTransaksi::class);
}

}

