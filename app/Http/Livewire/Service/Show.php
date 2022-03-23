<?php

namespace App\Http\Livewire\Service;

use App\Models\FakturService;
use App\Models\PersetujuanService;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public $service;
    
    // Persetujuan
    public $statusPersetujuan;
    public $keteranganPersetujuan;

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
