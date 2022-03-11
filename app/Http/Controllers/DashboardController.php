<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $uncheckedAmount = count(Service::where('dicek', false)->get());
        $unfinishedAmount = count(Service::where('service_selesai', false)->get());
        $approvalPendingAmount = count(Service::where('mau_diservice', null)->get());

        return view('dashboard', [
            'uncheckedAmount' => $uncheckedAmount,
            'unfinishedAmount' => $unfinishedAmount,
            'approvalPendingAmount' => $approvalPendingAmount
        ]);
    }
}
