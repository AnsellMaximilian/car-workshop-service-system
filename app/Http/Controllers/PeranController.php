<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    public function index()
    {
        $perans = Peran::all();

        return view('perans.index', ['perans' => $perans]);
    }
}
