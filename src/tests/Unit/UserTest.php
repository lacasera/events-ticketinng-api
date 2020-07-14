<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

test('user should have the right attributes', function() {
   $user  = factory(User::class)->raw();

   $attributes = [
       'email',
       'password',
       'device_type',
       'device_token',
       'phone'
   ];

   $count = count($attributes);

   for ($i=0; $i <$count ; $i++) { 
      assertArrayHasKey($attributes[$i], $user); 
   }
});

test('should have events attribute', function() {
    $user = factory(User::class)->create();

    assertInstanceOf(Collection::class, $user->events);
});

test('should have payment accounts attributes', function() {
    $user = factory(User::class)->create();

    assertInstanceOf(Collection::class, $user->paymentAccounts);
});
