<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\Kendaraan;
use Livewire\Component;

class Create extends Component
{
    public $tipes;
    public $selectedKendaraanId;

    public function mount()
    {
        $firstKendaraan = Kendaraan::first();
        if($firstKendaraan){
            $this->selectedKendaraanId = $firstKendaraan->id;
        }
    }

    public function render()
    {
        if($this->selectedKendaraanId){
           $selectedKendaraan = Kendaraan::find($this->selectedKendaraanId);
        }

        return view('livewire.work-order.create', [
            'kendaraans' => Kendaraan::all(),
            'selectedKendaraan' => $selectedKendaraan
        ]);
    }
}