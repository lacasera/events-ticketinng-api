<?php

namespace App\Domain\Repositories\Events;

use Illuminate\Support\ServiceProvider;

class EventRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }
}
