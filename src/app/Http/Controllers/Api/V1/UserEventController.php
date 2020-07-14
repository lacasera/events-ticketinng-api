<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\EventCreated;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

use App\Http\Requests\CreateEventRequest;


class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Event::forUser(auth()->id())->orderBy('created_at', 'desc')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $event = auth()->user()->events()->create($request->except('images'));

        event(new EventCreated($event, collect($request->images)));
        
        return response()->json([
            'data' => $event
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
         $this->authorize('update', $event);

        $event->update($request->all());

        return response()->json([
            'data' => 'event updated successfully'
        ], 200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json([
            'data' => 'event deleted successfully'
        ], 200);
    }
}
