<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaanPemeriksaan extends Model
{
    use HasFactory;

    public function pemeriksaan_standar()
    {
        return $this->belongsTo(PemeriksaanStandar::class);
    }
}
