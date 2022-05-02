<?php

namespace App\Http\Livewire\FakturService;

use App\Mail\ServiceFinished;
use App\Models\CompanyConfiguration;
use App\Models\FakturService;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $faktuService;

    // Pembayaran
    public $tipePembayaran = 'cash';
    public $tanggalPembayaran;
    public $buktiPembayaran;
    public $keteranganPembayaran;
    public $isPaymentModalOpen = false;

    public function mount($id)
    {
        $this->fakturService = FakturService::find($id);
    }

    public function setPaymentModalState($isOpen)
    {
        $this->isPaymentModalOpen = $isOpen;
    }

    public function savePembayaran()
    {
        $this->validate([
            'tanggalPembayaran' => 'required|date',
            'tipePembayaran' => 'required|in:cash,debit',
            'buktiPembayaran' => 'nullable|mimes:jpg,jpeg,png',
            'keteranganPembayaran' => 'max:255'
        ]);

        $pembayaran = new Pembayaran();
        $pembayaran->tanggal = $this->tanggalPembayaran;
        $pembayaran->tipe_pembayaran = $this->tipePembayaran;
        $pembayaran->keterangan = $this->keteranganPembayaran;
        $pembayaran->user_id = auth()->user()->id;

        if($this->buktiPembayaran){
            $photoPath = $this->buktiPembayaran->store('payments', 'public');
            $pembayaran->bukti_pembayaran = $photoPath;
        }

        $this->fakturService->service->pembayaran()->save($pembayaran);
        $this->fakturService->service->refresh();
        $this->isPaymentModalOpen = false;

        Mail::to($this->service->pendaftaran_service->pelanggan->email)->send(new ServiceFinished($this->faktuService->service));

    }

    public function render()
    {
        return view('livewire.faktur-service.show', [
            'fakturService' => $this->faktuService,
            'config' => CompanyConfiguration::first()
        ]);
    }
}
