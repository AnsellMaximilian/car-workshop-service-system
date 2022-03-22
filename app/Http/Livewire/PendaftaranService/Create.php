<?php

namespace App\Http\Livewire\PendaftaranService;

use App\Models\JenisService;
use App\Models\Pelanggan;
use App\Models\SukuCadang;
use Livewire\Component;

class Create extends Component
{
    
    // Service    
    public $selectedJenisServiceId;
    public $jenisServiceAmount;

    public $servicePredictions = [ ];
    public $serviceIndex = 0;

    // Suku Cadang    
    public $selectedSukuCadangId;
    public $sukuCadangAmount;

    public $sukuCadangPredictions = [ ];
    public $sukuCadangIndex = 0;

    public function mount()
    {
        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[0] = $firstJenisService->id;
        $this->jenisServiceAmount[0] = 0;

        $firstSukuCadang = SukuCadang::first();
        
        $this->selectedSukuCadangId[0] = $firstSukuCadang->id;
        $this->sukuCadangAmount[0] = 0;
    }

    public function addServicePrediction()
    {
        $this->serviceIndex++;

        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[$this->serviceIndex] = $firstJenisService->id;

        array_push($this->servicePredictions, $this->serviceIndex);
        $this->jenisServiceAmount[$this->serviceIndex] = 0;
    }

    public function removeServicePrediction($index)
    {
        unset($this->servicePredictions[$index]);
    }

    public function addSukuCadangPrediction()
    {
        $this->sukuCadangIndex++;

        $firstSukuCadang = SukuCadang::first();
        
        $this->selectedSukuCadangId[$this->sukuCadangIndex] = $firstSukuCadang->id;

        array_push($this->sukuCadangPredictions, $this->sukuCadangIndex);
        $this->sukuCadangAmount[$this->sukuCadangIndex] = 0;
    }

    public function removeSukuCadangPrediction($index)
    {
        unset($this->sukuCadangPredictions[$index]);
    }

    public function render()
    {
        $selectedJenisService = [];
        $selectedJenisService[0] = JenisService::first();
        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        $selectedSukuCadang = [];
        $selectedSukuCadang[0] = SukuCadang::first();
        foreach ($this->sukuCadangPredictions as $key => $sukuCadangIndex) {
            $selectedSukuCadang[$sukuCadangIndex] = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex]);
        }

        $totalPerkiraanService = ($selectedJenisService[0]->harga * $this->jenisServiceAmount[0]);
        foreach ($this->servicePredictions as $key => $index) {
            $totalPerkiraanService += ($selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        $totalPerkiraanSukuCadang = ($selectedSukuCadang[0]->harga * $this->sukuCadangAmount[0]);
        foreach ($this->sukuCadangPredictions as $key => $index) {
            $totalPerkiraanSukuCadang += ($selectedSukuCadang[$index]->harga * $this->sukuCadangAmount[$index]);
        }

        return view('livewire.pendaftaran-service.create', [
            'pelanggans' => Pelanggan::all(),
            'jenisServices' => JenisService::all(),
            'sukuCadangs' => SukuCadang::all(),
            'selectedJenisService' => $selectedJenisService,
            'selectedSukuCadang' => $selectedSukuCadang,
            'totalPerkiraanService' => $totalPerkiraanService,
            'totalPerkiraanSukuCadang' => $totalPerkiraanSukuCadang
        ]);
    }
}
