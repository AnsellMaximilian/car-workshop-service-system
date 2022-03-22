<?php

namespace App\Http\Livewire\Service;

use App\Models\JenisService;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\Service;
use App\Models\SukuCadang;
use Livewire\Component;

class Edit extends Component
{
    public $service;

    // Service    
    public $selectedJenisServiceId;
    public $selectedJenisService;
    public $jenisServiceAmount;

    public $penjualanServices = [ ];
    public $serviceIndex = 0;

    // Suku Cadang    
    public $selectedSukuCadangId;
    public $selectedSukuCadang;
    public $sukuCadangAmount;

    public $penggantianSukuCadangs = [ ];
    public $sukuCadangIndex = 0;

    public function mount()
    {
        foreach ($this->service->penjualan_services as $key => $penjualanService) {
            $this->serviceIndex++;
            $this->selectedJenisServiceId[$this->serviceIndex] = $penjualanService->jenis_service->id;
            array_push($this->penjualanServices, $this->serviceIndex);
            $this->jenisServiceAmount[$this->serviceIndex] = $penjualanService->jumlah;
        }

        foreach ($this->service->penggantian_suku_cadangs as $key => $penggantianSukuCadang) {
            $this->sukuCadangIndex++;
            $this->selectedSukuCadangId[$this->sukuCadangIndex] = $penggantianSukuCadang->suku_cadang->id;
            array_push($this->penggantianSukuCadangs, $this->sukuCadangIndex);
            $this->sukuCadangAmount[$this->sukuCadangIndex] = $penggantianSukuCadang->jumlah;
        }
    }

    public function addPenjualanService()
    {
        $this->serviceIndex++;

        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[$this->serviceIndex] = $firstJenisService->id;

        array_push($this->penjualanServices, $this->serviceIndex);
        $this->jenisServiceAmount[$this->serviceIndex] = 0;
    }

    public function removePenjualanService($index)
    {
        unset($this->penjualanServices[$index]);
    }

    public function addPenggantianSukuCadang()
    {
        $this->sukuCadangIndex++;

        $firstSukuCadang = SukuCadang::first();
        
        $this->selectedSukuCadangId[$this->sukuCadangIndex] = $firstSukuCadang->id;

        array_push($this->penggantianSukuCadangs, $this->sukuCadangIndex);
        $this->sukuCadangAmount[$this->sukuCadangIndex] = 0;
    }

    public function removePenggantianSukuCadang($index)
    {
        unset($this->penggantianSukuCadangs[$index]);
    }

    public function save()
    {
        PenjualanService::where('service_id', $this->service->id)->delete();
        PenggantianSukuCadang::where('service_id', $this->service->id)->delete();

        foreach ($this->penjualanServices as $key => $serviceIndex) {
            $penjualanService = new PenjualanService();
            $penjualanService->jenis_service_id = $this->selectedJenisServiceId[$serviceIndex];
            $penjualanService->jumlah = $this->jenisServiceAmount[$serviceIndex];
            $penjualanService->harga = $this->selectedJenisService[$serviceIndex]['harga'];
            $this->service->penjualan_services()->save($penjualanService);
        }

        foreach ($this->penggantianSukuCadangs as $key => $sukuCadangIndex) {
            $penggantianSukuCadanngs = new PenggantianSukuCadang();
            $penggantianSukuCadanngs->suku_cadang_id = $this->selectedSukuCadangId[$sukuCadangIndex];
            $penggantianSukuCadanngs->jumlah = $this->sukuCadangAmount[$sukuCadangIndex];
            $penggantianSukuCadanngs->harga = $this->selectedSukuCadang[$sukuCadangIndex]['harga'];
            $this->service->penggantian_suku_cadangs()->save($penggantianSukuCadanngs);
        }

        $this->service->save();
        
        return redirect(route('services.index'));
    }

    public function render()
    {
        foreach ($this->penjualanServices as $key => $serviceIndex) {
            $this->selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        foreach ($this->penggantianSukuCadangs as $key => $sukuCadangIndex) {
            $this->selectedSukuCadang[$sukuCadangIndex] = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex]);
        }

        $totalPenjualanServices = 0;
        foreach ($this->penjualanServices as $key => $index) {
            $totalPenjualanServices += ($this->selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        $totalPenggantianSukuCadangs = 0;
        foreach ($this->penggantianSukuCadangs as $key => $index) {
            $totalPenggantianSukuCadangs += ($this->selectedSukuCadang[$index]->harga * $this->sukuCadangAmount[$index]);
        }

        return view('livewire.service.edit', [
            'jenisServices' => JenisService::all(),
            'sukuCadangs' => SukuCadang::all(),
            'totalPenjualanServices' => $totalPenjualanServices,
            'totalPenggantianSukuCadangs' => $totalPenggantianSukuCadangs
        ]);
    }
}