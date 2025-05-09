@php
    $studentsCount = \App\Models\User::role('student')->count();
    $teachersCount = \App\Models\User::role('teacher')->count();
    $parentsCount = \App\Models\User::role('parent')->count();
    $subjectsCount = \App\Models\Subject::count();
@endphp
<div id="dashboard-page" class="page-content active">
    <!-- بطاقات الإحصائيات -->
    <section class="stats-cards">
        <div class="card">
            <div class="card-icon bg-blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-info">
                <h3>{{ $studentsCount }}</h3>
                <p>الطلاب</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon bg-green">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-info">
                <h3>{{ $teachersCount }} </h3>
                <p>المدرسين</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon bg-orange">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="card-info">
                <h3>{{ $parentsCount }}</h3>
                <p>أولياء الأمور</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon bg-purple">
                <i class="fas fa-book"></i>
            </div>
            <div class="card-info">
                <h3>{{ $subjectsCount }}</h3>
                <p>المواد الدراسية</p>
            </div>
        </div>
    </section>
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
    <!-- الأحداث القادمة -->
    <section class="upcoming-events">
        <h2 class="section-title"><i class="fas fa-calendar-alt"></i> الأحداث القادمة</h2>
        <div class="events-container">
            <div class="event-list">
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
    </section>

    <!-- الرسائل الجديدة -->
    {{-- <section class="messages-section">
        <h2 class="section-title"><i class="fas fa-envelope"></i> الرسائل الجديدة</h2>

        <div class="message-item">
            <img src="https://via.placeholder.com/40" alt="صورة المرسل" class="message-avatar">
            <div class="message-content">
                <div class="message-header">
                    <span class="message-sender">أحمد محمد (ولي أمر)</span>
                    <span class="message-time">منذ ساعتين</span>
                </div>
                <p class="message-text">السلام عليكم، أريد الاستفسار عن موعد اجتماع أولياء الأمور القادم وهل
                    يمكن تأجيله؟</p>
                <div class="message-reply">
                    <textarea placeholder="اكتب ردك هنا..."></textarea>
                    <div class="message-actions">
                        <button class="btn btn-primary">إرسال الرد</button>
                    </div>
                </div>
                <button class="reply-btn">رد</button>
            </div>
        </div>

        <div class="message-item">
            <img src="https://via.placeholder.com/40" alt="صورة المرسل" class="message-avatar">
            <div class="message-content">
                <div class="message-header">
                    <span class="message-sender">المدرس خالد عبدالله</span>
                    <span class="message-time">منذ يوم</span>
                </div>
                <p class="message-text">تحية طيبة، أود التنسيق لاجتماع طارئ لمناقشة مستوى الطلاب في مادة
                    الرياضيات</p>
                <div class="message-reply">
                    <textarea placeholder="اكتب ردك هنا..."></textarea>
                    <div class="message-actions">
                        <button class="btn btn-primary">إرسال الرد</button>
                    </div>
                </div>
                <button class="reply-btn">رد</button>
            </div>
        </div>
    </section> --}}
</div>
