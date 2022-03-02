<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PeranController;
use App\Http\Livewire\UserPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('perans', [PeranController::class, 'index'])->name('perans');

    Route::name('pelanggans.')->group(function(){
        Route::get('pelanggans', [PelangganController::class, 'index'])->name('index');
        Route::get('pelanggans/create', [PelangganController::class, 'create'])->name('create');
        Route::post('pelanggans', [PelangganController::class, 'store'])->name('store');
        Route::get('pelanggans/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('edit');
        Route::patch('pelanggans/{pelanggan}', [PelangganController::class, 'update'])->name('update');
    });

    Route::name('kendaraans.')->group(function(){
        Route::get('kendaraans', [KendaraanController::class, 'index'])->name('index');
        Route::get('kendaraans/create', [KendaraanController::class, 'create'])->name('create');
        Route::post('kendaraans', [KendaraanController::class, 'store'])->name('store');
        Route::get('kendaraans/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name('edit');
        Route::patch('kendaraans/{kendaraan}', [KendaraanController::class, 'update'])->name('update');
    });
});



require __DIR__.'/auth.php';
