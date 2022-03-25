<?php

namespace App\Observers;

use App\Models\PemeriksaanStandar;
use App\Models\Service;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        //
    }

    /**
     * Handle the Service "updating" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updating(Service $service)
    {
        if($service->status_service === 'mulai' && $service->pelaksanaan_pemeriksaans()->count() > 0){
            request()->session()->flash('error', 'Service tidak bisa kembali ke status mulai. Pemeriksaan standar sudah ada yang dilakukan.');
            return false;
        }

        if($service->status_service === 'service'){
            if ($service->pelaksanaan_pemeriksaans()->count() < count(PemeriksaanStandar::all())) {
                request()->session()->flash('error', 'Service tidak bisa maju ke status service. Pemeriksaan belum dilakukan semua.');
                return false;
            }elseif (!$service->isServiceApproved()) {
                request()->session()->flash('error', 'Service tidak bisa maju ke status service. Memerlukan persetujuan.');
                return false;
            }
        }
        if($service->persetujuan_service && $service->status_service === 'cek'){
            request()->session()->flash('error', 'Service tidak bisa kembali ke status dicek. Sudah memiliki persetujuan.');
            return false;
        }

    }

    /**
     * Handle the Service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        //
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }

    /**
     * Handle the Service "deleting" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleting(Service $service)
    {
        return ! $service->persetujuan_service;
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}
