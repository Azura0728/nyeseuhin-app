<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'outlet_id'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}