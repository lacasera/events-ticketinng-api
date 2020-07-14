<?php

namespace App\Listeners;

use App\Events\EventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class SaveEventImages
{
    protected $images;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $eventCreated)
    {
        $images = $eventCreated->images->map(fn($image) => ['url' => Storage::put('images', $image)]);        
        logger($images);
        $eventCreated->event->images()->createMany($images);
    }
}
