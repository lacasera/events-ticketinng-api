<?php

use App\Domain\Services\Events\EventService;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'msg' => 'api is healthy'
    ]);
});
