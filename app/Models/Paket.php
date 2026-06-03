<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = ['outlet_id', 'nama_paket', 'jenis', 'harga'];

    /**
     * Get the outlet that owns the paket.
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    /**
     * Get the formatted paket ID (PKT-001).
     */
    public function getFormattedIdAttribute()
    {
        return 'PKT-' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get the formatted outlet ID (OTL-001).
     */
    public function getFormattedOutletIdAttribute()
    {
        return 'OTL-' . str_pad($this->outlet_id, 3, '0', STR_PAD_LEFT);
    }
}
