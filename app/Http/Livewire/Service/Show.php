<?php

namespace App\Http\Livewire\Service;

use App\Models\FakturService;
use App\Models\Pembayaran;
use App\Models\PersetujuanService;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $service;
    
    // Persetujuan
    public $statusPersetujuan;
    public $keteranganPersetujuan;

    // Pembayaran
    public $tipePembayaran = 'cash';
    public $tanggalPembayaran;
    public $buktiPembayaran;
    public $keteranganPembayaran;

    public function mount($id)
    {
        $this->service = Service::find($id);
    }

    public function savePersetujuan()
    {
        $this->validate([
            'statusPersetujuan' => 'in:setuju,tolak',
            'keteranganPersetujuan' => 'max:255'
        ]);

        $persetujuan = new PersetujuanService();
        $persetujuan->keterangan = $this->keteranganPersetujuan;
        $persetujuan->status_persetujuan = $this->statusPersetujuan;
        $persetujuan->waktu_persetujuan = now();

        $this->service->persetujuan_service()->save($persetujuan);
        $this->service->refresh();
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

        if($this->buktiPembayaran){
            // $photoFile = $request->file('photo');
            $photoPath = $this->buktiPembayaran->store('payments', 'public');
            $pembayaran->bukti_pembayaran = $photoPath;
        }

        $this->service->pembayaran()->save($pembayaran);
        $this->service->refresh();
    }

    public function saveFakturService()
    {
        $this->authorize('create', FakturService::class);

        $newFakturService = new FakturService();
        $newFakturService->service_id = $this->service->id;
        $newFakturService->tanggal = now();
        $newFakturService->save();

        return redirect(route('faktur-services.show', $newFakturService->id));
    }

    public function render()
    {
        return view('livewire.service.show', [
        ]);
    }
}
