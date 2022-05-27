<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisService extends Model
{
    use HasFactory;

    public function penjualan_services()
    {
        return $this->hasMany(PenjualanService::class);
    }

    public function perkiraan_penjualan_services()
    {
        return $this->hasMany(PerkiraanPenjualanService::class);
    }
}
