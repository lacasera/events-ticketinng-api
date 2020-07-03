<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\{Event, Ticket};
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTicketRequest;
use Illuminate\Auth\Access\AuthorizationException;

class TicketController extends Controller
{
    
    public function index(Event $event)
    {
        return response()->json([
            'data' => $event->tickets
        ], 200);
    }

    public function store(CreateTicketRequest $request, Event $event)
    {
    
        throw_if($event->user->id !== auth()->id(), new AuthorizationException);

        return response()->json([
            'data' => $event->tickets()->create($request->all())
        ], 201); 
    }

    public function update(Request $request, Event $event, Ticket $ticket)
    {
        $this->authorize('update', $event, $ticket);

        $ticket->update($request->all());

        return response()->json([
            'data' => 'ticket updated successfully'
        ], 200);
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        $this->authorize('delete', $event, $ticket);

        $ticket->delete();

        return response()->json([
            'data' => 'ticket deleted successfully'
        ], 200);
    }
}
