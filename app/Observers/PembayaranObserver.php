<?php

namespace App\Observers;

use App\Models\Pembayaran;
use App\Models\Service;

class PembayaranObserver
{
    /**
     * Handle the Pembayaran "created" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function created(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Handle the Pembayaran "creating" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function creating(Pembayaran $pembayaran)
    {
        // $service = Service::find($pembayaran->service_id);

        // $isFinished = $service->isServiceFinished();

        // if($isFinished){
        //     request()->session()->flash('error', 'Service belum selesai. Tidak bisa mencatat pembayaran.');

        // }

        $canBePaid = $pembayaran->service->isServiceApproved();

        if(!$canBePaid){
            request()->session()->flash('error', 'Belum bisa dibayar.');
        }

        return $canBePaid;
        
    }

    /**
     * Handle the Pembayaran "updated" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function updated(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Handle the Pembayaran "deleted" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function deleted(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Handle the Pembayaran "restored" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function restored(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Handle the Pembayaran "force deleted" event.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return void
     */
    public function forceDeleted(Pembayaran $pembayaran)
    {
        //
    }
}
