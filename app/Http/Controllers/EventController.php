<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;

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
            $events = $this->EventService->getEvents();
            return self::paginated($events, EventResource::class, 'Events retrieved successfully', 200);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->EventService->storeEvent($request->validated());
        return self::success(new EventResource($event),'Event Created Successfully',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(event $event)
    {
        //
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
    public function destroy(event $event)
    {
        //
    }
}
