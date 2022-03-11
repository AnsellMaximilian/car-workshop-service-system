<?php

namespace App\Http\Controllers;

use App\Models\FakturService;
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
        return view('faktur-services.create');
    }

    public function store(Request $request)
    {
        
    }

}
