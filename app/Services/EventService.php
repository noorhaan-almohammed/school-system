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
}
