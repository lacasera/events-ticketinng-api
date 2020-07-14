<?php

namespace App\Providers;

use App\Models\{
    Event, 
    PaymentAccount, 
    Ticket
};

use App\Policies\{
    EventPolicy, 
    PaymentAccountPolicy, 
    TicketPolicy
};

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        Ticket::class => TicketPolicy::class,
        PaymentAccount::class => PaymentAccountPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
