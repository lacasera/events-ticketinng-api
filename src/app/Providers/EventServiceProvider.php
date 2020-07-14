<?php

namespace App\Providers;

use App\Events\EventCreated;
use App\Events\PaymentConfirmed;
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
        EventCreated::class => [
            '\App\Listeners\SaveEventImages'
        ],
        PaymentConfirmed::class => [
            '\App\Listeners\LogTransaction',
            '\App\Listeners\GenerateTicket',
            '\App\Listeners\SendTicketInvoice'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
