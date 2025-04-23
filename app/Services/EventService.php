<?php

namespace App\Services;

use App\Models\Event;

class EventService
{

    public function createEvent($data)
    {
        Event::create($data);
        return "تم إنشاء الحدث بنجاح";

    }

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
