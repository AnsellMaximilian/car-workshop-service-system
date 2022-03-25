<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // public function getTotalAR()
    // {
    //     return $this->services->reduce(function($total, $service){
    //         return $total + $service->faktur_service->getAmountToBePaid();
    //     }, 0);
    // }

    public function getTotalAR()
    {
        return $this->pendaftaran_services()
        ->whereHas('service', function(Builder $q){
            $q->whereHas('persetujuan_service', function(Builder $q2){
                $q2->where('status_persetujuan', 'setuju');
            });
        })->get()
        ->reduce(function($total, $pendaftaran){
            return $total + $pendaftaran->service->getGrandTotal();
        }, 0);
    }

    public function pendaftaran_services()
    {
        return $this->hasMany(PendaftaranService::class);
    }

    public function getServices()
    {
        return $this->pendaftaran_services->map(function($pendaftaran){
            return $pendaftaran->service;
        });
    }
}
