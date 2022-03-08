<?php

namespace App\Http\Livewire\FakturService;

use App\Models\FakturService;
use Livewire\Component;

class Show extends Component
{
    public $faktuService;

    public function mount($id)
    {
        $this->fakturService = FakturService::find($id);
    }

    public function render()
    {
        return view('livewire.faktur-service.show', [
            'fakturService' => $this->faktuService,
        ]);
    }
}
