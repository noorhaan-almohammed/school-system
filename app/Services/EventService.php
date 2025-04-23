<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class EventService
{

    public function createEvent($data)
    {
        Event::create($data);
        return "تم إنشاء الحدث بنجاح";

    }
    public function deleteEvent($id){
        try{
            $event = Event::findOrFail($id);
            $eventName = $event->name ;
            $event->delete();
            return 'تم حذف حدث ال '.$eventName.' بنجاح';
        }catch(ModelNotFoundException $e){
            Log::error('Error when delete event '.$e->getMessage());
            return 'حدث خطأ أثناء عملية الحذف';
        }
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
