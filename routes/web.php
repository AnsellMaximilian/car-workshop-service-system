<?php

use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/users', UserPage::class)->middleware(['auth'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('perans', [PeranController::class, 'index'])->name('perans');
});


require __DIR__.'/auth.php';
