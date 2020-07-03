<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Domain\Services\Events\EventService;

class EventController extends Controller
{

    protected $eventService;

    public function __constructor(EventService $eventService )
    {
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([ new EventCollection(Event::paginate(50)) ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' =>Event::findOrFail($id)
        ], 200);
    }
}
