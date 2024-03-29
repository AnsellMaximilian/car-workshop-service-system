<?php

namespace App\Observers;

use App\Models\PelaksanaanPemeriksaan;
use App\Models\Service;

class PelaksanaanPemeriksaanObserver
{
    /**
     * Handle the PelaksanaanPemeriksaan "created" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function created(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        //
    }

    /**
     * Handle the PelaksanaanPemeriksaan "creating" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function creating(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        // $service = Service::find($pelaksanaanPemeriksaan->service_id);

        // $isChecking = $service->status_service === 'cek';

        // if(!$isChecking){
        //     request()->session()->flash('error', 'Pemeriksaan standar tidak dicatat. Ubah status service menjadi dicek dahulu.');
        // }

        // return $isChecking;
    }

    /**
     * Handle the PelaksanaanPemeriksaan "updated" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function updated(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        //
    }

    /**
     * Handle the PelaksanaanPemeriksaan "updating" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function updating(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        
    }

    /**
     * Handle the PelaksanaanPemeriksaan "deleted" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function deleted(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        //
    }

    /**
     * Handle the PelaksanaanPemeriksaan "deleting" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function deleting(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        // $service = Service::find($pelaksanaanPemeriksaan->service_id);

        // $isChecking = $service->status_service === 'cek';

        // if(!$isChecking){
        //     request()->session()->flash('error', 'Ubah status service menjadi dicek.');
        // }

        // return $isChecking;
    }

    /**
     * Handle the PelaksanaanPemeriksaan "restored" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function restored(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        //
    }

    /**
     * Handle the PelaksanaanPemeriksaan "force deleted" event.
     *
     * @param  \App\Models\PelaksanaanPemeriksaan  $pelaksanaanPemeriksaan
     * @return void
     */
    public function forceDeleted(PelaksanaanPemeriksaan $pelaksanaanPemeriksaan)
    {
        //
    }
}
