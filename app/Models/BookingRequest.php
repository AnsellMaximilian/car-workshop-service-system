<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function pendaftaran_service()
    {
        return $this->hasOne(PendaftaranService::class);
    }
}
