<?php

use App\Http\Controllers\ActionsPageController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\CompanyConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakturServiceController;
use App\Http\Controllers\JenisServiceController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemeriksaanStandarController;
use App\Http\Controllers\PendaftaranServiceController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Livewire\FakturService\Show as FakturServiceShow;
use App\Http\Livewire\MerkDanTipe\Index as MerkDanTipeIndex;
use App\Http\Livewire\Pelanggan\Show as PelangganShow;
use App\Http\Livewire\Service\Show as ServiceShow;
use App\Http\Livewire\SukuCadang\Show as SukuCadangShow;
use App\Http\Livewire\BookingRequest\Show as BookingShow;
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
    // return view('welcome');
    return redirect(route('dashboard'));
});

Route::get('/booking', [BookingRequestController::class, 'create'])->name('booking');
Route::post('/booking', [BookingRequestController::class, 'store'])->name('booking.store');
Route::get('/booking/thanks', [BookingRequestController::class, 'thanks'])->name('booking.thanks');

Route::middleware('auth')->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [RegisteredUserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}', [RegisteredUserController::class, 'show'])->name('users.show');

    // Route::get('actions/{code}', [ActionsPageController::class, 'admn'])->name('actions.admn');

    Route::get('perans', [PeranController::class, 'index'])->name('perans');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('pelanggans.')->group(function(){
        Route::get('pelanggans', [PelangganController::class, 'index'])->name('index');
        Route::get('pelanggans/create', [PelangganController::class, 'create'])->name('create');
        Route::post('pelanggans', [PelangganController::class, 'store'])->name('store');
        Route::get('pelanggans/{id}', PelangganShow::class)->name('show');
        Route::get('pelanggans/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('edit');
        Route::patch('pelanggans/{pelanggan}', [PelangganController::class, 'update'])->name('update');
        Route::delete('pelanggans/{pelanggan}', [PelangganController::class, 'destroy'])->name('destroy');
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
        Route::delete('suku-cadangs/{suku_cadang}', [SukuCadangController::class, 'destroy'])->name('destroy');
    });

    Route::name('jenis-services.')->group(function(){
        Route::get('jenis-services', [JenisServiceController::class, 'index'])->name('index');
        Route::get('jenis-services/create', [JenisServiceController::class, 'create'])->name('create');
        Route::post('jenis-services', [JenisServiceController::class, 'store'])->name('store');
        Route::get('jenis-services/{jenis_service}/edit', [JenisServiceController::class, 'edit'])->name('edit');
        Route::patch('jenis-services/{jenis_service}', [JenisServiceController::class, 'update'])->name('update');
        Route::delete('jenis-services/{jenis_service}', [JenisServiceController::class, 'destroy'])->name('destroy');
    });

    Route::name('pemeriksaan-standars.')->group(function(){
        Route::get('pemeriksaan-standars', [PemeriksaanStandarController::class, 'index'])->name('index');
        Route::get('pemeriksaan-standars/create', [PemeriksaanStandarController::class, 'create'])->name('create');
        Route::post('pemeriksaan-standars', [PemeriksaanStandarController::class, 'store'])->name('store');
        Route::get('pemeriksaan-standars/{pemeriksaan_standar}/edit', [PemeriksaanStandarController::class, 'edit'])->name('edit');
        Route::patch('pemeriksaan-standars/{pemeriksaan_standar}', [PemeriksaanStandarController::class, 'update'])->name('update');
        Route::delete('pemeriksaan-standars/{pemeriksaan_standar}', [PemeriksaanStandarController::class, 'destroy'])->name('destroy');
    });

    Route::name('pendaftaran-services.')->group(function(){
        Route::get('pendaftaran-services', [PendaftaranServiceController::class, 'index'])->name('index');
        Route::get('pendaftaran-services/create', [PendaftaranServiceController::class, 'create'])->name('create');
        Route::post('pendaftaran-services', [PendaftaranServiceController::class, 'store'])->name('store');
        Route::get('pendaftaran-services/{pendaftaran_service}', [PendaftaranServiceController::class, 'show'])->name('show');
        Route::get('pendaftaran-services/{pendaftaran_service}/edit', [PendaftaranServiceController::class, 'edit'])->name('edit');
        Route::patch('pendaftaran-services/{pendaftaran_service}', [PendaftaranServiceController::class, 'update'])->name('update');
        Route::delete('pendaftaran-services/{pendaftaran_service}', [PendaftaranServiceController::class, 'destroy'])->name('destroy');
    });

    Route::name('bookings.')->group(function(){
        Route::get('bookings', [BookingRequestController::class, 'index'])->name('index');
        Route::get('bookings/{id}', BookingShow::class)->name('show');
        Route::delete('bookings/{booking}', [BookingRequestController::class, 'destroy'])->name('destroy');
    });

    Route::name('services.')->group(function(){
        Route::get('services', [ServiceController::class, 'index'])->name('index');
        Route::get('services/create', [ServiceController::class, 'create'])->name('create');
        Route::post('services', [ServiceController::class, 'store'])->name('store');
        Route::get('services/{id}', ServiceShow::class)->name('show');
        // Route::get('services/{service}', [ServiceController::class, 'show'])->name('show');
        Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::patch('services/{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    Route::name('faktur-services.')->group(function(){
        Route::get('faktur-services', [FakturServiceController::class, 'index'])->name('index');
        Route::get('faktur-services/create', [FakturServiceController::class, 'create'])->name('create');
        Route::post('faktur-services', [FakturServiceController::class, 'store'])->name('store');
        Route::get('faktur-services/{id}', FakturServiceShow::class)->name('show');
        Route::delete('faktur-services/{faktur_service}', [FakturServiceController::class, 'destroy'])->name('destroy');
    });

    Route::name('pembayarans.')->group(function(){
        Route::get('pembayarans', [PembayaranController::class, 'index'])->name('index');
        Route::get('pembayarans/create', [PembayaranController::class, 'create'])->name('create');
        Route::post('pembayarans', [PembayaranController::class, 'store'])->name('store');
        Route::get('pembayarans/{service}/edit', [PembayaranController::class, 'edit'])->name('edit');
        Route::patch('pembayarans/{service}', [PembayaranController::class, 'update'])->name('update');
    });

    Route::name('configurations.')->group(function(){
        Route::get('configurations', [CompanyConfigurationController::class, 'index'])->name('index');
        Route::patch('configurations/{company_configuration}', [CompanyConfigurationController::class, 'update'])->name('update');
    });

    Route::name('notifications.')->group(function(){
        Route::get('notifications/service-payment-due/{id}', [NotificationController::class, 'ServicePaymentDue'])->name('ServicePaymentDue');
        Route::get('notifications/booking-requested/{id}', [NotificationController::class, 'BookingRequested'])->name('BookingRequested');
    });
});



require __DIR__.'/auth.php';
