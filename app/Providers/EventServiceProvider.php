<?php

namespace App\Providers;

use App\Models\PelaksanaanPemeriksaan;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\Service;
use App\Observers\PelaksanaanPemeriksaanObserver;
use App\Observers\PenggantianSukuCadangObserver;
use App\Observers\PenjualanServiveObserver;
use App\Observers\ServiceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Service::observe(ServiceObserver::class);
        PelaksanaanPemeriksaan::observe(PelaksanaanPemeriksaanObserver::class);
        PenggantianSukuCadang::observe(PenggantianSukuCadangObserver::class);
        PenjualanService::observe(PenjualanServiveObserver::class);
    }
}
