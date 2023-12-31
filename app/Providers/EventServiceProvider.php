<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;

//Evento login
use Illuminate\Auth\Events\Login;
//Evento logout
use Illuminate\Auth\Events\Logout;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\Product;
use App\Observers\ProductObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */

     //Definicion de eventos y oyentes
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //Evento login
        Login::class => [
            //Oyentes que se generan
            "App\Listeners\MergeTheCart"
        ],

        //Evento logout
        Logout::class => [
            //Oyentes que se generan
            "App\Listeners\MergeTheCartLogout"
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //Registrar Observador para el modelo Product
        
        /* Cada que realizemos una operacion CRUD en el modelo producto,
           verifica con el observador si queremos escuchar algun metodo
        */
        Product::observe(ProductObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
