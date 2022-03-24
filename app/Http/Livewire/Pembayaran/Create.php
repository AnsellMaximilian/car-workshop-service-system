<?php

namespace App\Http\Livewire\Pembayaran;

use App\Models\FakturService;
use App\Models\Pembayaran;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $selectedServiceId;
    public $keterangan;
    // public $jumlah;
    public $tanggalPembayaran;
    public $tipePembayaran;
    public $buktiPembayaran;

    public function mount()
    {
        $firstService = Service::getAllPayable()->first();
        if($firstService){
            $this->selectedServiceId = $firstService->id;
        }

        $this->tipePembayaran = 'cash';
    }
    
    public function savePembayaran()
    {
        $this->authorize('create', Pembayaran::class);

        $this->validate([
            'selectedServiceId' => 'required|exists:services,id',
            // 'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|max:255',
            'tanggalPembayaran' => 'required|date',
            'buktiPembayaran' => 'nullable|mimes:jpg,jpeg,png',
            'tipePembayaran' => 'required|in:cash,debit',
        ]);

        $pembayaran = new Pembayaran();

        $pembayaran->service_id = $this->selectedServiceId;
        // $pembayaran->jumlah = $this->jumlah;
        $pembayaran->tanggal = $this->tanggalPembayaran;
        $pembayaran->tipe_pembayaran = $this->tipePembayaran;
        // $pembayaran->kembali = Service::find($this->selectedServiceId)->getChange($this->jumlah);
        $pembayaran->keterangan = $this->keterangan;

        if($this->buktiPembayaran){
            $photoPath = $this->buktiPembayaran->store('payments', 'public');
            $pembayaran->bukti_pembayaran = $photoPath;
        }

        $pembayaran->save();

        return redirect(route('pembayarans.index'));
    }

    public function render()
    {
        if($this->selectedServiceId){
            $selectedService = Service::find($this->selectedServiceId);
        }

        return view('livewire.pembayaran.create', [
            'services' => Service::getAllPayable(),
            'selectedService' => $selectedService
            // 'selectedWorkOrder' => $selectedWorkOrder
        ]);
    }
}
