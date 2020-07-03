<?php

use App\Models\Event;
use App\Models\Image;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 1000)
            ->create()
            ->each(function($event){
                $event->images()->create(factory(Image::class)->raw());
                $event->tickets()->create(factory(Ticket::class)->raw());
            });
    }
}
