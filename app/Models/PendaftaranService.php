<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranService extends Model
{
    use HasFactory;

    public function perkiraan_suku_cadangs()
    {
        return $this->hasMany(PerkiraanSukuCadang::class);
    }

    public function perkiraan_penjualan_services()
    {
        return $this->hasMany(PerkiraanPenjualanService::class);
    }
}
