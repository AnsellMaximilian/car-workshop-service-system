<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $reportStartDate;
    public $reportEndDate;
    

    public function render()
    {
        // $unfinishedAmount = count(Service::where('service_selesai', false)->get());
        $approvalPendingAmount = count(Service::where('mau_diservice', null)->get());

        $services = Service::where('mau_diservice', true)->get();
        
        $reportServices = $services->whereBetween('tanggal', [date($this->reportStartDate), date($this->reportEndDate)]);

        $totalSales = $services->reduce(function($total, $service) {
            return $total + $service->getGrandTotal();
        }, 0);

        $totalSalesToday = $services
            ->filter(function($service){
                return (new Carbon($service->tanggal))->isToday();
            })
            ->reduce(function($total, $service) {
                return $total + $service->getGrandTotal();
            }, 0);

        // dd($totalSalesToday);

        return view('livewire.dashboard', [
            // 'unfinishedAmount' => $unfinishedAmount,
            'approvalPendingAmount' => $approvalPendingAmount,
            'totalSales' => $totalSales,
            'totalSalesToday' => $totalSalesToday,
            'services' => $services,
            'reportServices' => $reportServices
        ]);
    }
}
