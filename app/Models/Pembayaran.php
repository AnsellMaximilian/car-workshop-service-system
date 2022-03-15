<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // public function faktur_service()
    // {
    //     return $this->belongsTo(FakturService::class);
    // }

    public function getTotal()
    {
        return $this->jumlah - $this->kembali;
    }
}
