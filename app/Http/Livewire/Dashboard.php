<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Dashboard extends Component
{
    

    public function render()
    {
        $unfinishedAmount = count(Service::where('service_selesai', false)->get());
        $approvalPendingAmount = count(Service::where('mau_diservice', null)->get());

        $totalSales = Service::all()->reduce(function($total, $service) {
            return $total + (!$service->isServiceCancelled() ? $service->getGrandTotal() : 0);
        }, 0);

        return view('livewire.dashboard', [
            'unfinishedAmount' => $unfinishedAmount,
            'approvalPendingAmount' => $approvalPendingAmount,
            'totalSales' => $totalSales
        ]);
    }
}
