<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function faktur_service()
    {
        return $this->hasOne(FakturService::class);
    }

    public function pelaksanaan_pemeriksaans()
    {
        return $this->hasMany(PelaksanaanPemeriksaan::class);
    }

    public function pendaftaran_service()
    {
        return $this->belongsTo(PendaftaranService::class);
    }

    public function penjualan_services()
    {
        return $this->hasMany(PenjualanService::class);
    }

    public function penggantian_suku_cadangs()
    {
        return $this->hasMany(PenggantianSukuCadang::class);
    }

    public function persetujuan_service()
    {
        return $this->hasOne(PersetujuanService::class);
    }

    public function getTotalPenjualanServices()
    {
        return $this->penjualan_services->reduce(function($total, $penjualan){
            return $total + $penjualan->getTotal();
        }, 0);
    }

    public function getTotalPenggantianSukuCadangs()
    {
        return $this->penggantian_suku_cadangs->reduce(function($total, $penggantian){
            return $total + $penggantian->getTotal();
        }, 0);
    }

    public function getGrandTotal()
    {
        return $this->getTotalPenjualanServices() + $this->getTotalPenggantianSukuCadangs();
    }

    public function isServiceApproved()
    {
        return $this->isApprovalPending() ? false : (
            $this->persetujuan_service->status_persetujuan === 'setuju'
        );
    }

    public function isServiceCancelled()
    {
        return $this->isApprovalPending() ? false : (
            $this->persetujuan_service->status_persetujuan === 'tolak'
        );
    }

    public function isApprovalPending()
    {
        return $this->persetujuan_service === null;
    }

    public function isPaymentPending()
    {
        return $this->pembayaran === null;
    }

    public function isPenggantianSukuCadangEmpty()
    {
        return (count($this->penggantian_suku_cadangs) <= 0);
    }

    public function isPenjualanServiceEmpty()
    {
        return (count($this->penjualan_services) <= 0);
    }

    public function isEmpty()
    {
        return $this->isPenggantianSukuCadangEmpty() && $this->isPenjualanServiceEmpty();
    }

    public function canBeDeleted()
    {
        return $this->isEmpty() 
            && ($this->isApprovalPending());
    }

    public function canBeInvoiced()
    {
        return $this->status_service === 'selesai';
    }

    public function invoiced()
    {
        return $this->faktur_service !== null;
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

    public static function getAllInvoicable()
    {
        return Service::all()->filter(function($service){
            return $service->canBeInvoiced() && !$service->invoiced();
        });
    }

    public static function getStatusMap($reverse = false)
    {
        return !$reverse ? [
            0 => 'mulai',
            1 => 'cek',
            2 => 'service',
            3 => 'selesai',
        ] : [
            'mulai' => 0,
            'cek' => 1,
            'service' => 2,
            'selesai' => 3,
        ];
    }

    public static function getNewStatus($status, $steps)
    {
        $map = Service::getStatusMap();
        $mapReverse = Service::getStatusMap(true);
        $pos = $mapReverse[$status];
        $newPos = (($pos + $steps) > max($mapReverse)) ? max($mapReverse) : 0;
        $newPos = (($pos + $steps) < 0) ? 0 : ($pos +$steps);

        return $map[$newPos];
    }
    
}
