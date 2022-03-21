<?php

namespace App\Http\Livewire\PendaftaranService;

use App\Models\JenisService;
use App\Models\Pelanggan;
use Livewire\Component;

class Create extends Component
{
    
    
    public $selectedJenisServiceId;
    public $jenisServiceAmount;


    // public $servicePrediction;
    public $servicePredictions = [ ];
    public $serviceIndex = 0;

    public function mount()
    {
        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[0] = $firstJenisService->id;
        $this->jenisServiceAmount[0] = 0;
    }

    public function addServicePrediction()
    {
        // $this->validate([
        //     'jenisServiceAmount' => 'required|numeric|min:0',
        //     'selectedJenisServiceId' => 'required|exists:jenis_services,id',
        // ]);

        $this->serviceIndex++;

        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[$this->serviceIndex] = $firstJenisService->id;

        array_push($this->servicePredictions, $this->serviceIndex);
        $this->jenisServiceAmount[$this->serviceIndex] = 0;
    }

    public function test()
    {
        dd($this->servicePredictions);
    }

    public function removeServicePrediction($index)
    {
        // dd($index);

        unset($this->servicePredictions[$index]);
    }

    public function render()
    {
        // if($this->selectedJenisServiceId){
        //     $selectedJenisService = JenisService::find($this->selectedJenisServiceId);
        // }else {
        //     $selectedJenisService = new JenisService();
        // }

        $selectedJenisService = [];
        $selectedJenisService[0] = JenisService::first();
        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        $totalPerkiraanService = ($selectedJenisService[0]->harga * $this->jenisServiceAmount[0]);
        foreach ($this->servicePredictions as $key => $index) {
            $totalPerkiraanService += ($selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        return view('livewire.pendaftaran-service.create', [
            'pelanggans' => Pelanggan::all(),
            'jenisServices' => JenisService::all(),
            'selectedJenisService' => $selectedJenisService,
            'totalPerkiraanService' => $totalPerkiraanService
        ]);
    }
}
