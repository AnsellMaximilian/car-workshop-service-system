<?php

namespace App\Http\Controllers;

use App\Models\FakturService;
use App\Models\Service;
use Illuminate\Http\Request;

class FakturServiceController extends Controller
{
    public function index()
    {
        return view('faktur-services.index');
    }

    public function show(FakturService $fakturService)
    {
        return view('faktur-services.show', ['fakturService' => $fakturService]);
    }

    public function create()
    {
        
        $this->authorize('create', FakturService::class);

        $servicesReadyToBeInvoiced = Service::where('service_selesai', true)->get()->filter(function ($service) {
            return !$service->invoiced();
        });

        if(count($servicesReadyToBeInvoiced) <= 0 ){
            return redirect(route('faktur-services.index'))->with('error', 'Tidak ada service yang siap dibuat fakturnya.');
        }

        return view('faktur-services.create');
    }

    public function store(Request $request)
    {
        
    }

}
