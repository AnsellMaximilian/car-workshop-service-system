<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Livewire\MerkDanTipe\Index as MerkDanTipeIndex;
use App\Http\Livewire\SukuCadang\Show as SukuCadangShow;
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

    Route::get('merk-dan-tipe-kendaraan', MerkDanTipeIndex::class)->name('merks-dan-tipes');

    Route::name('kendaraans.')->group(function(){
        Route::get('kendaraans', [KendaraanController::class, 'index'])->name('index');
        Route::get('kendaraans/create', [KendaraanController::class, 'create'])->name('create');
        Route::post('kendaraans', [KendaraanController::class, 'store'])->name('store');
        Route::get('kendaraans/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name('edit');
        Route::patch('kendaraans/{kendaraan}', [KendaraanController::class, 'update'])->name('update');
    });

    Route::name('suku-cadangs.')->group(function(){
        Route::get('suku-cadangs', [SukuCadangController::class, 'index'])->name('index');
        Route::get('suku-cadangs/create', [SukuCadangController::class, 'create'])->name('create');
        Route::post('suku-cadangs', [SukuCadangController::class, 'store'])->name('store');
        Route::get('suku-cadangs/{id}', SukuCadangShow::class)->name('show');
        Route::get('suku-cadangs/{suku_cadang}/edit', [SukuCadangController::class, 'edit'])->name('edit');
        Route::patch('suku-cadangs/{suku_cadang}', [SukuCadangController::class, 'update'])->name('update');
    });
});



require __DIR__.'/auth.php';
