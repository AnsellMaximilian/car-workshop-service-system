<?php

namespace App\Http\Livewire\Pelanggan;

use App\Models\Pelanggan;
use Livewire\Component;

class Show extends Component
{
    public $pelanggan;

    public function mount($id)
    {
        $this->pelanggan = Pelanggan::find($id);
    }
    
    public function render()
    {
        return view('livewire.pelanggan.show');
    }
}
