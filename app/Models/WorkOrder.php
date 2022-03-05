<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    public function markAsChecked()
    {
        if(!$this->dicek){
            $this->dicek = true;
            $this->save();
        }
    }

    public function markAsApproved()
    {
        if($this->dicek){
            $this->mau_diservice = true;
            $this->save();
        }
    }

    public function markAsCancelled()
    {
        if($this->dicek){
            $this->mau_diservice = false;
            $this->save();
        }
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
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
}