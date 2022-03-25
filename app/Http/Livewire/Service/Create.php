<?php

namespace App\Http\Livewire\Service;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use App\Models\Service;
use Livewire\Component;

class Create extends Component
{
    public $selectedPendaftaranServiceId;

    public function mount()
    {
        $firstPendaftaranService = PendaftaranService::getAllNotContinued()->first();

        $this->selectedPendaftaranServiceId = $firstPendaftaranService->id;
    }

    public function save()
    {
        $this->validate([
            'selectedPendaftaranServiceId' => 'required|exists:pendaftaran_services,id'
        ]);

        $service = new Service();

        $service->pendaftaran_service_id = $this->selectedPendaftaranServiceId;
        $service->waktu_mulai = now();

        $service->save();

        // Saving pendaftaran

        return redirect(route('services.index'));
    }

    public function render()
    {
        $selectedPendaftaranService = PendaftaranService::find($this->selectedPendaftaranServiceId);

        return view('livewire.service.create', [
            'pendaftaranServices' => PendaftaranService::getAllNotContinued(),
            'selectedPendaftaranService' => $selectedPendaftaranService
        ]);
    }
}
