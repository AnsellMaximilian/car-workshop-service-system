<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkiraanSukuCadang extends Model
{
    use HasFactory;

    public function getTotal()
    {
        return $this->harga * $this->jumlah;
    }

    public function suku_cadang()
    {
        return $this->belongsTo(SukuCadang::class);
    }

    public function pendaftaran_service()
    {
        return $this->belongsTo(PendaftaranService::class);
    }
}
