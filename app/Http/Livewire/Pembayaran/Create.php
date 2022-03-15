<?php

namespace App\Http\Livewire\Pembayaran;

use App\Models\FakturService;
use App\Models\Pembayaran;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $selectedServiceId;
    public $keterangan;
    public $jumlah;

    public function mount()
    {
        $firstService = Service::first();
        if($firstService){
            $this->selectedServiceId = $firstService->id;
        }
    }
    
    public function savePembayaran()
    {
        $this->authorize('create', Pembayaran::class);

        $this->validate([
            'selectedServiceId' => 'required|exists:faktur_services,id',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|max:255',
        ]);

        $pembayaran = new Pembayaran();

        $pembayaran->service_id = $this->selectedServiceId;
        $pembayaran->jumlah = $this->jumlah;
        $pembayaran->tanggal = now();
        $pembayaran->kembali = Service::find($this->selectedServiceId)->getChange($this->jumlah);
        $pembayaran->keterangan = $this->keterangan;

        $pembayaran->save();

        return redirect(route('pembayarans.index'));
    }

    public function render()
    {
        if($this->selectedServiceId){
            $selectedService = Service::find($this->selectedServiceId);
        }

        $fakturServices = FakturService::all();

        return view('livewire.pembayaran.create', [
            'fakturServices' => $fakturServices,
            'selectedService' => $selectedService
            // 'selectedWorkOrder' => $selectedWorkOrder
        ]);
    }
}
