<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    use HasFactory;

    public function getTotalPemasukkan()
    {
        return $this->pemasukkan_suku_cadangs->reduce(function($total, $pemasukkan){
            return $total + $pemasukkan->jumlah;
        }, 0);
    }

    public function getCurrentStock()
    {
        return $this->stok_awal + $this->getTotalPemasukkan();
    }

    public function pemasukkan_suku_cadangs()
    {
        return $this->hasMany(PemasukkanSukuCadang::class);
    }

    public function getCurrentStockAttribute()
    {
        return $this->getCurrentStock();
    }
}
