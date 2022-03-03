<?php

namespace App\Http\Livewire\SukuCadang;
use App\Models\SukuCadang;

use Livewire\Component;

class Show extends Component
{
    public $sukuCadang;

    public function mount($id)
    {
        $this->sukuCadang = SukuCadang::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.suku-cadang.show', ['sukuCadang' => $this->sukuCadang]);
    }
}
