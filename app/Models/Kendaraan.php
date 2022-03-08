<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function getFullName()
    {
        return $this->tipe->merk->merk . ' ' . $this->tipe->tipe;
    }
}
