<?php

namespace App\Providers;

use App\Models\Certificado;
use App\Models\Inscripcion;
use App\Models\PlanificacionCarrera;
use App\Models\RegistroEconomico;
use App\Observers\CertificadoModularObserver;
use App\Observers\InscripcionObserver;
use App\Observers\PlanificacionCarreraObserver;
use App\Observers\RegistroEconomicoObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
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
        Inscripcion::observe(InscripcionObserver::class);
        RegistroEconomico::observe(RegistroEconomicoObserver::class);
        PlanificacionCarrera::observe(PlanificacionCarreraObserver::class);
        Certificado::observe(CertificadoModularObserver::class);
    }
}
