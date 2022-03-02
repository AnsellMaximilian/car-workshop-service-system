<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Merk;
use App\Models\Pelanggan;
use App\Models\Tipe;
use Livewire\Component;

class Edit extends Component
{
    public $kendaraan;
    public $tipes;
    public $selectedMerkId;

    public function mount()
    {
        $this->selectedMerkId = old('merk_id') ? old('merk_id') : $this->kendaraan->tipe->merk->id;
    }

    public function render()
    {
        if($this->selectedMerkId){
            $this->tipes = Tipe::where('merk_id', $this->selectedMerkId)->get();
        }else {
            $this->tipes = [];
        }

        return view('livewire.kendaraan.edit', [
            'pelanggans' => Pelanggan::all(),
            'merks' => Merk::all()
        ]);
    }

}
