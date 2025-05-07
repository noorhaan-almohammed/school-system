<div id="events-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-calendar-plus"></i> إدارة الأحداث</h2>
            <button class="add-new-btn" id="add-event-btn"><i class="fas fa-plus"></i> إضافة حدث
                جديد</button>
        </div>
        @php
            use Carbon\Carbon;
            $events = \App\Models\Event::get();
            $months = [
                1 => 'يناير',
                2 => 'فبراير',
                3 => 'مارس',
                4 => 'أبريل',
                5 => 'مايو',
                6 => 'يونيو',
                7 => 'يوليو',
                8 => 'أغسطس',
                9 => 'سبتمبر',
                10 => 'أكتوبر',
                11 => 'نوفمبر',
                12 => 'ديسمبر',
            ];
        @endphp
        <div class="events-container">
            <div class="events-filters">
                <div class="filter-group">
                    <label for="event-type">نوع الحدث:</label>
                    <select id="event-type" class="filter-select">
                        <option value="all">الكل</option>
                        <option value="meeting">اجتماع</option>
                        <option value="exam">اختبار</option>
                        <option value="holiday">إجازة</option>
                        <option value="celebration">احتفال</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="event-month">الشهر:</label>
                    <select id="event-month" class="filter-select">
                        <option value="all">الكل</option>
                        @foreach ($months as $index => $month)
                            <option value="{{ $index }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <button class="btn btn-filter" >
                        <i class="fas fa-filter"></i> تصفية
                    </button>
                </div>
            </div>


            <div class="events-list">


                @foreach ($events as $event)
                    @php
                        $eventDate = Carbon::parse($event->date);
                        $day = $eventDate->format('d');
                        $month = $months[(int) $eventDate->format('m')];
                        $startTime = $event->time->format('h:i');
                        $endTime = $event->time->copy()->addHours($event->duration)->format('h:i');
                        $startAmPm = $event->time->format('A') === 'AM' ? 'صباحاً' : 'مساءً';
                        $endAmPm =
                            $event->time->copy()->addHours($event->duration)->format('A') === 'AM' ? 'صباحاً' : 'مساءً';
                    @endphp

                    <div class="event-card" data-id="{{ $event->id }}">
                        <div class="event-date">
                            <span class="day">{{ $day }}</span>
                            <span class="month">{{ $month }}</span>
                        </div>
                        <div class="event-details">
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <div class="event-meta">
                                {{-- <span class="event-type"><i class="fas fa-file-alt"></i> اختبار</span> --}}
                                <span class="event-time">
                                    <i class="fas fa-clock"></i>
                                    {{ $startTime }} {{ $startAmPm }} - {{ $endTime }} {{ $endAmPm }}
                                </span>
                            </div>
                            <p class="event-description">{{ $event->description }}</p>
                            <div class="event-actions">
                                <button class="btn btn-sm delete-btn" data-id="{{ $event->id }}">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
