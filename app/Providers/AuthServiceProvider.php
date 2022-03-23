<?php

namespace App\Providers;

use App\Models\FakturService;
use App\Models\JenisService;
use App\Models\Kendaraan;
use App\Models\Merk;
use App\Models\Pelanggan;
use App\Models\PemeriksaanStandar;
use App\Models\Peran;
use App\Models\Service;
use App\Models\SukuCadang;
use App\Models\Tipe;
use App\Models\User;
use App\Policies\FakturServicePolicy;
use App\Policies\JenisServicePolicy;
use App\Policies\KendaraanPolicy;
use App\Policies\MerkPolicy;
use App\Policies\PelangganPolicy;
use App\Policies\PemeriksaanStandarPolicy;
use App\Policies\PeranPolicy;
use App\Policies\ServicePolicy;
use App\Policies\SukuCadangPolicy;
use App\Policies\TipePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Peran::class => PeranPolicy::class,
        Pelanggan::class => PelangganPolicy::class,
        Kendaraan::class => KendaraanPolicy::class,
        Merk::class => MerkPolicy::class,
        Tipe::class, TipePolicy::class,
        JenisService::class => JenisServicePolicy::class,
        SukuCadang::class => SukuCadangPolicy::class,
        Service::class => ServicePolicy::class,
        FakturService::class => FakturServicePolicy::class,
        PemeriksaanStandar::class => PemeriksaanStandarPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
