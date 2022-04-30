<?php

namespace App\Http\Livewire\Service;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $selectedPendaftaranServiceId;

    public function mount()
    {
        $firstPendaftaranService = PendaftaranService::getAllNotContinued()->first();

        $this->selectedPendaftaranServiceId = $firstPendaftaranService->id;
    }

    public function save()
    {
        $this->authorize('create', Service::class);

        $this->validate([
            'selectedPendaftaranServiceId' => 'required|exists:pendaftaran_services,id'
        ]);

        $service = new Service();

        $service->pendaftaran_service_id = $this->selectedPendaftaranServiceId;
        $service->waktu_mulai = now();

        $service->save();

        // Saving perkiraan
        foreach ($service->pendaftaran_service->perkiraan_penjualan_services as $key => $perkiraanService) {
            $penjualanService = new PenjualanService();
            $penjualanService->jenis_service_id = $perkiraanService->jenis_service_id;
            $penjualanService->jumlah = $perkiraanService->jumlah;
            $penjualanService->harga = $perkiraanService->harga;
            $service->penjualan_services()->save($penjualanService);
        }

        foreach ($service->pendaftaran_service->perkiraan_suku_cadangs as $key => $perkiraanPenggantian) {
            $penggantian = new PenggantianSukuCadang();
            $penggantian->suku_cadang_id = $perkiraanPenggantian->suku_cadang_id;
            $penggantian->jumlah = $perkiraanPenggantian->jumlah;
            $penggantian->harga = $perkiraanPenggantian->harga;
            $service->penggantian_suku_cadangs()->save($penggantian);
        }

        return redirect(route('services.show', $service->id));
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
