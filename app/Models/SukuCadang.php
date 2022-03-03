<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    use HasFactory;

    public function getCurrentStock()
    {
        return $this->stok_awal;
    }
}
