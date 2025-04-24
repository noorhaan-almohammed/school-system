<div id="events-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-calendar-plus"></i> إدارة الأحداث</h2>
            <button class="add-new-btn" id="add-event-btn"><i class="fas fa-plus"></i> إضافة حدث
                جديد</button>
        </div>

        <div class="events-container">
            <div class="events-filters">
                <div class="filter-group">
                    <label for="event-type">نوع الحدث:</label>
                    <select id="event-type">
                        <option value="all">الكل</option>
                        <option value="meeting">اجتماع</option>
                        <option value="exam">اختبار</option>
                        <option value="holiday">إجازة</option>
                        <option value="celebration">احتفال</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="event-month">الشهر:</label>
                    <select id="event-month">
                        <option value="all">الكل</option>
                        <option value="1">يناير</option>
                        <option value="2">فبراير</option>
                        <!-- باقي الأشهر -->
                    </select>
                </div>
                <button class="btn btn-primary">تصفية</button>
            </div>

            <div class="events-list">
                <div class="event-card">
                    <div class="event-date">
                        <span class="day">15</span>
                        <span class="month">مايو</span>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">اجتماع أولياء الأمور</h3>
                        <div class="event-meta">
                            <span class="event-type"><i class="fas fa-users"></i> اجتماع</span>
                            <span class="event-time"><i class="fas fa-clock"></i> 03:00 مساءً - 05:00
                                مساءً</span>
                        </div>
                        <p class="event-description">اجتماع دوري مع أولياء الأمور لمناقشة تقدم الطلاب</p>
                        <div class="event-actions">
                            <button class="btn btn-sm btn-delete delete-btn"><i class="fas fa-trash"></i>
                                حذف</button>
                        </div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-date">
                        <span class="day">20</span>
                        <span class="month">مايو</span>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">اختبار نهاية الفصل</h3>
                        <div class="event-meta">
                            <span class="event-type"><i class="fas fa-file-alt"></i> اختبار</span>
                            <span class="event-time"><i class="fas fa-clock"></i> 08:00 صباحاً - 10:00
                                صباحاً</span>
                        </div>
                        <p class="event-description">اختبار نهاية الفصل الدراسي الثاني لجميع الصفوف</p>
                        <div class="event-actions">
                            <button class="btn btn-sm btn-delete"><i class="fas fa-trash"></i>
                                حذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
