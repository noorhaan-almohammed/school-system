<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'ورشة عمل البرمجة',
                'date' => Carbon::now()->addDays(2)->toDateString(),
                'time' => '10:30',
                'duration' => 2,
                'description' => 'ورشة لتعليم أساسيات البرمجة بلغة PHP.'
            ],
            [
                'title' => 'اجتماع أولياء الأمور',
                'date' => Carbon::now()->addWeek()->toDateString(),
                'time' => '17:00',
                'duration' => 1,
                'description' => 'اجتماع لمناقشة أداء الطلاب وخطط التحسين.'
            ],
            [
                'title' => 'الرحلة المدرسية',
                'date' => Carbon::now()->addDays(10)->toDateString(),
                'time' => '08:00',
                'duration' => 3,
                'description' => 'رحلة ترفيهية إلى الحديقة العامة.'
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
