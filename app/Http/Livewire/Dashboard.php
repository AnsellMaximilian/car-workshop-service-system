<?php

namespace App\Http\Livewire;

use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use App\Models\Service;
use App\Models\SukuCadang;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $reportStartDate;
    public $reportEndDate;

    public function mount()
    {
        $this->reportStartDate = today()->format('Y-m-d');
        $this->reportEndDate = today()->format('Y-m-d');
    }

    public function render()
    {
        $totalPendaftaranPending = count(PendaftaranService::getAllNotContinued());
        $totalApprovalPending = count(Service::doesntHave('persetujuan_service')->get());
        $totalPembayaranPending = count(Service::doesntHave('pembayaran')->get());

        $paidServices = Service::whereHas('pembayaran')->get();
        
        $reportServices = $paidServices->whereBetween('waktu_mulai', [$this->reportStartDate, $this->reportEndDate]);

        $totalSales = $paidServices->reduce(function($total, $service) {
            return $total + $service->getGrandTotal();
        }, 0);

        $totalSalesToday = $paidServices
            ->filter(function($service){
                return (new Carbon($service->waktu_mulai))->isToday();
            })
            ->reduce(function($total, $service) {
                return $total + $service->getGrandTotal();
            }, 0);

        return view('livewire.dashboard', [
            'totalApprovalPending' => $totalApprovalPending,
            'totalSales' => $totalSales,
            'totalSalesToday' => $totalSalesToday,
            'reportServices' => $reportServices,
            'totalPendaftaranPending' => $totalPendaftaranPending,
            'totalPembayaranPending' => $totalPembayaranPending,
        ]);
    }
}
