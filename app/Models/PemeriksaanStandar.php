<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanStandar extends Model
{
    use HasFactory;

    public function pelaksanaan_pemeriksaans()
    {
        return $this->hasMany(PelaksanaanPemeriksaan::class);
    }
}
