<?php

namespace App\Http\Controllers;

use App\Models\CompanyConfiguration;
use Illuminate\Http\Request;

class CompanyConfigurationController extends Controller
{
    public function index()
    {
        $config = CompanyConfiguration::first();
        if(!$config){
            return redirect('/dashboard');
        }
        return view('company-configurations.index', [
            'config' => $config
        ]);
    }

    public function update(CompanyConfiguration $company_configuration, Request $request)
    {
        $company_configuration->rekening_bca = $request->rekening_bca;
        $company_configuration->rekening_bni = $request->rekening_bni;
        $company_configuration->alamat = $request->alamat;
        $company_configuration->email = $request->email;
        $company_configuration->no_telp = $request->no_telp;
        $company_configuration->hp_1 = $request->hp_1;
        $company_configuration->hp_2 = $request->hp_2;

        $company_configuration->save();

        return redirect(route('configurations.index'));
    }
}
