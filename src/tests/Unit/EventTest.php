<?php

use App\Models\{Event, User};
use Illuminate\Database\Eloquent\Collection;

test('event should have the right attributes', function() {
   $event  = factory(Event::class)->raw();

   $attributes = [
       'description',
       'user_id',
       'starting',
       'ending',
       'is_verified',
       'latitude',
       'longitude',
       'venue',
       'title'
   ];

   $count = count($attributes);

   for ($i=0; $i <$count ; $i++) { 
      assertArrayHasKey($attributes[$i], $event); 
   }
});

test('event should have a created attribute', function() {
    $event = factory(Event::class)->create();
    assertTrue(is_string($event->created));
});

test('scope for user must return events belonging to a user', function() {

    $user = factory(User::class)->create();

    factory(Event::class)->create(['user_id' => $user->id]);

    $events = Event::forUser($user->id)->first();

    assertEquals($events->user_id, $user->id);
});

test('event should have images', function () {
    $event = factory(Event::class)->create();
    assertInstanceOf(Collection::class, $event->images);
});

test('event should have tickets', function () {
    $event = factory(Event::class)->create();
    assertInstanceOf(Collection::class, $event->tickets);
});

test('event should belong to a user', function() {
    $event = factory(Event::class)->create();
    assertInstanceOf(User::class, $event->user);
});
