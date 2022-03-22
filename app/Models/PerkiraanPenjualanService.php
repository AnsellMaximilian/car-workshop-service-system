<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkiraanPenjualanService extends Model
{
    use HasFactory;

    public function getTotal()
    {
        return $this->harga * $this->jumlah;
    }

    public function jenis_service()
    {
        return $this->belongsTo(JenisService::class);
    }
}
