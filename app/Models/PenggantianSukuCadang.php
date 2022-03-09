<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggantianSukuCadang extends Model
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

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
