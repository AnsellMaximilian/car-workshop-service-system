<?php

namespace App\Http\Livewire\Pembayaran;

use App\Models\FakturService;
use App\Models\Pembayaran;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $selectedFakturServiceId;
    public $keterangan;
    public $jumlah;

    public function mount()
    {
        $firstFakturService = FakturService::first();
        if($firstFakturService){
            $this->selectedFakturServiceId = $firstFakturService->id;
        }
    }
    
    public function savePembayaran()
    {
        $this->authorize('create', Pembayaran::class);

        $this->validate([
            'selectedFakturServiceId' => 'required|exists:faktur_services,id',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|max:255',
        ]);

        $pembayaran = new Pembayaran();

        $pembayaran->faktur_service_id = $this->selectedFakturServiceId;
        $pembayaran->jumlah = $this->jumlah;
        $pembayaran->tanggal = now();
        $pembayaran->kembali = FakturService::find($this->selectedFakturServiceId)->getChange($this->jumlah);
        $pembayaran->keterangan = $this->keterangan;

        $pembayaran->save();

        return redirect(route('pembayarans.index'));
    }

    public function render()
    {
        if($this->selectedFakturServiceId){
            $selectedFakturService = FakturService::find($this->selectedFakturServiceId);
        }

        $fakturServices = FakturService::all();

        return view('livewire.pembayaran.create', [
            'fakturServices' => $fakturServices,
            'selectedFakturService' => $selectedFakturService
            // 'selectedWorkOrder' => $selectedWorkOrder
        ]);
    }
}
