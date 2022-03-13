<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function markAsApproved()
    {
        $this->mau_diservice = true;
        $this->save();
    }

    public function markAsCancelled()
    {
        $this->mau_diservice = false;
        $this->save();
    }

    public function markAsFinished()
    {
        if($this->mau_diservice){
            $this->service_selesai = true;
            $this->save();
        }
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function penjualan_services()
    {
        return $this->hasMany(PenjualanService::class);
    }

    public function penggantian_suku_cadangs()
    {
        return $this->hasMany(PenggantianSukuCadang::class);
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
        return $this->mau_diservice === 1;
    }

    public function isServiceCancelled()
    {
        return $this->mau_diservice === 0;
    }

    public function isApprovalPending()
    {
        return !$this->isServiceApproved() && !$this->isServiceCancelled();
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
        return $this->service_selesai === 1;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasAnyPenjualanServices()
    {
        return count($this->penjualan_services) > 0;
    }

    public function hasAnyPenggantianSukuCadangs()
    {
        return count($this->penggantian_suku_cadangs) > 0;
    }

    public function invoiced()
    {
        return $this->faktur_service !== null;
    }
    
}
