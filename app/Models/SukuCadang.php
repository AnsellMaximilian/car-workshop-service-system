<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SukuCadang extends Model
{
    use HasFactory;

    public function getTotalPemasukkan()
    {
        return $this->pemasukkan_suku_cadangs->reduce(function($total, $pemasukkan){
            return $total + $pemasukkan->jumlah;
        }, 0);
    }

    public function getTotalPengeluaran()
    {
        return $this->pengeluaran_suku_cadangs->reduce(function($total, $pengeluaran){
            return $total + $pengeluaran->jumlah;
        }, 0);
    }

    public function getTotalPenggantian()
    {

        return $this->penggantian_suku_cadangs->reduce(function($total, $penggantian){
            return $total + (!$penggantian->service->isServiceCancelled() ? $penggantian->jumlah : 0);
        }, 0);
    }

    public function getTotalPerkiraan()
    {
        
        return $this->perkiraan_suku_cadangs()->whereHas('pendaftaran_service', function(Builder $q){
            $q->doesntHave('service');
        })->get()
        ->reduce(function($total, $perkiraan){
            return $total + $perkiraan->jumlah;
        }, 0);
        
    }

    public function getCurrentStock()
    {
        return $this->stok_awal 
            + $this->getTotalPemasukkan() 
            - $this->getTotalPengeluaran() 
            - $this->getTotalPerkiraan() 
            - $this->getTotalPenggantian();
    }

    public function pemasukkan_suku_cadangs()
    {
        return $this->hasMany(PemasukkanSukuCadang::class);
    }

    public function pengeluaran_suku_cadangs()
    {
        return $this->hasMany(PengeluaranSukuCadang::class);
    }

    public function penggantian_suku_cadangs()
    {
        return $this->hasMany(PenggantianSukuCadang::class);
    }

    public function perkiraan_suku_cadangs()
    {
        return $this->hasMany(PerkiraanSukuCadang::class);
    }

    public function getCurrentStockAttribute()
    {
        return $this->getCurrentStock();
    }
}
