<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    public function getTotalAR()
    {
        return $this->services->reduce(function($total, $service){
            return $total + $service->faktur_service->getAmountToBePaid();
        }, 0);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
