<?php

namespace App\Http\Livewire\FakturService;

use App\Models\FakturService;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $selectedServiceId;

    public function mount()
    {
        $firstService = Service::all()->filter(function($service){
            return !$service->invoiced();
        })->first();

        if($firstService){
            $this->selectedServiceId = $firstService->id;
        }
    }
    
    public function saveFakturService()
    {
        $this->authorize('create', FakturService::class);

        $this->validate([
            'selectedServiceId' => 'required|exists:services,id',
        ]);

        $newFakturService = new FakturService();
        $newFakturService->service_id = $this->selectedServiceId;
        $newFakturService->tanggal = now();
        $newFakturService->save();

        return redirect(route('faktur-services.show', $newFakturService->id));
    }

    public function render()
    {

        $services = Service::all();

        if($this->selectedServiceId){
            $selectedService = Service::find($this->selectedServiceId);
        }else {
            $selectedService = new Service();
        }

        return view('livewire.faktur-service.create', [
            'services' => $services->filter(function ($service) {
                return $service->canBeInvoiced();
            }),
            'selectedService' => $selectedService
        ]);
    }
}
