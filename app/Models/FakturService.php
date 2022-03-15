<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturService extends Model
{
    use HasFactory;

    // public function work_order()
    // {
    //     return $this->belongsTo(WorkOrder::class);
    // }

    public function isPaid()
    {
        return $this->dibayar === 1;
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getGrandTotal()
    {
        return $this->service->getGrandTotal();
    }

    // public function pembayarans()
    // {
    //     return $this->hasMany(Pembayaran::class);
    // }

    // public function getTotalPembayaran()
    // {
    //     return $this->pembayarans->reduce(function($total, $pembayaran){
    //         return $total + $pembayaran->getTotal();
    //     }, 0);
    // }

    // public function getAmountToBePaid()
    // {
    //     return $this->getGrandTotal() - $this->getTotalPembayaran();
    // }

    // public function getChange($amountPaid)
    // {
    //     $change = $amountPaid - $this->getAmountToBePaid();

    //     return $change <= 0 ? 0 : $change;
    // }
}
