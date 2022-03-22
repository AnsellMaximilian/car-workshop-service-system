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

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function getTotalPerkiraanPenjualanServices()
    {
        return $this->perkiraan_penjualan_services->reduce(function($total, $penjualan){
            return $total + $penjualan->getTotal();
        }, 0);
    }

    public function getTotalPerkiraanSukuCadangs()
    {
        return $this->perkiraan_suku_cadangs->reduce(function($total, $penggantian){
            return $total + $penggantian->getTotal();
        }, 0);
    }

    public function getTotalPerkiraan()
    {
        return $this->getTotalPerkiraanPenjualanServices() + $this->getTotalPerkiraanSukuCadangs();
    }
}
