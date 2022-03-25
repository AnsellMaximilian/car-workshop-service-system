<?php

namespace App\Observers;

use App\Models\PenggantianSukuCadang;
use App\Models\Service;

class PenggantianSukuCadangObserver
{
    /**
     * Handle the PenggantianSukuCadang "created" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function created(PenggantianSukuCadang $penggantianSukuCadang)
    {
        //
    }

    /**
     * Handle the PenggantianSukuCadang "creating" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function creating(PenggantianSukuCadang $penggantianSukuCadang)
    {
        $service = Service::find($penggantianSukuCadang->service_id);

        $serviceApproval = $service->persetujuan_service;

        if($serviceApproval){
            request()->session()->flash('error', 'Service sudah memiliki persetujuan.');
        }

        return ! $serviceApproval;
    }

    /**
     * Handle the PenggantianSukuCadang "updated" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function updated(PenggantianSukuCadang $penggantianSukuCadang)
    {
        //
    }

    /**
     * Handle the PenggantianSukuCadang "deleted" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function deleted(PenggantianSukuCadang $penggantianSukuCadang)
    {
        //
    }

    /**
     * Handle the PenggantianSukuCadang "deleting" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function deleting(PenggantianSukuCadang $penggantianSukuCadang)
    {
        $service = Service::find($penggantianSukuCadang->service_id);

        $serviceApproval = $service->persetujuan_service;

        if($serviceApproval){
            request()->session()->flash('error', 'Service sudah memiliki persetujuan.');
        }

        return ! $serviceApproval;
    }

    /**
     * Handle the PenggantianSukuCadang "restored" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function restored(PenggantianSukuCadang $penggantianSukuCadang)
    {
        //
    }

    /**
     * Handle the PenggantianSukuCadang "force deleted" event.
     *
     * @param  \App\Models\PenggantianSukuCadang  $penggantianSukuCadang
     * @return void
     */
    public function forceDeleted(PenggantianSukuCadang $penggantianSukuCadang)
    {
        //
    }
}
