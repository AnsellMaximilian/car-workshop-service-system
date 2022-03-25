<?php

namespace App\Observers;

use App\Models\PenjualanService;
use App\Models\Service;

class PenjualanServiveObserver
{
    /**
     * Handle the PenjualanService "created" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function created(PenjualanService $penjualanService)
    {
        //
    }

    /**
     * Handle the PenjualanService "creating" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function creating(PenjualanService $penjualanService)
    {
        $service = Service::find($penjualanService->service_id);

        $serviceApproval = $service->persetujuan_service;

        if($serviceApproval){
            request()->session()->flash('error', 'Service sudah memiliki persetujuan.');
        }

        return ! $serviceApproval;
    }

    /**
     * Handle the PenjualanService "updated" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function updated(PenjualanService $penjualanService)
    {
        //
    }

    /**
     * Handle the PenjualanService "deleted" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function deleted(PenjualanService $penjualanService)
    {
        //
    }

    /**
     * Handle the PenjualanService "deleting" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function deleting(PenjualanService $penjualanService)
    {
        $service = Service::find($penjualanService->service_id);

        $serviceApproval = $service->persetujuan_service;

        if($serviceApproval){
            request()->session()->flash('error', 'Service sudah memiliki persetujuan.');
        }

        return ! $serviceApproval;
    }

    /**
     * Handle the PenjualanService "restored" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function restored(PenjualanService $penjualanService)
    {
        //
    }

    /**
     * Handle the PenjualanService "force deleted" event.
     *
     * @param  \App\Models\PenjualanService  $penjualanService
     * @return void
     */
    public function forceDeleted(PenjualanService $penjualanService)
    {
        //
    }
}
