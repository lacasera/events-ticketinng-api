<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Services\Events\EventService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;

use App\Events\EventCreated;
use App\Http\Resources\EventCollection;
use App\Models\Event;

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
