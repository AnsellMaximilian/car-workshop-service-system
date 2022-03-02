<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Merk;
use App\Models\Pelanggan;
use App\Models\Tipe;
use Livewire\Component;

class Create extends Component
{
    public $tipes;
    public $selectedMerkId;

    public function mount()
    {
        $firstMerk = Merk::first();
        if($firstMerk){
            $this->selectedMerkId = $firstMerk->id;
        }
    }

    public function render()
    {
        if($this->selectedMerkId){
            $this->tipes = Tipe::where('merk_id', $this->selectedMerkId)->get();
        }else {
            $this->tipes = [];
        }

        return view('livewire.kendaraan.create', [
            'pelanggans' => Pelanggan::all(),
            // 'tipes' => Tipe::all(),
            'merks' => Merk::all()
        ]);
    }
}
