<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';
    public $incrementing = false;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getTotal()
    {
        return $this->jumlah - $this->kembali;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
