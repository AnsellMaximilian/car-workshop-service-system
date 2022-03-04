<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanService extends Model
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
