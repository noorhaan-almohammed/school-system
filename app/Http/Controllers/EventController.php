<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    protected EventService $EventService;

    public function __construct(EventService $EventService)
    {
        $this->EventService = $EventService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(10);
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createEvent(EventRequest $request)
    {
        $data = $request->validated();
        $msg = $this->EventService->createEvent($data);
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $msg = $this->EventService->deleteEvent($id);
        return response()->json(['message' => $msg]);
    }
}
