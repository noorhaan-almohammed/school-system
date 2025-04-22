<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\event;


class EventService
{
    public function getEvents()
    {
        return event::paginate(10);
    }
    public function storeEvent(array $data)
    {
        $event = Event::create($data);
        return $event;
    }

}
