<aside class="sidebar">
    <div class="logo">
        <i class="fas fa-school"></i>
        <h2>نظام المدرسة</h2>
    </div>
    <nav class="nav-menu">
        <ul>
            <li class="active" data-page="dashboard"><a href="#"><i class="fas fa-tachometer-alt"></i> الرئيسية</a></li>
             @hasanyrole(['admin', 'teacher', 'parent'])
            <li data-page="students"><a href="#"><i class="fas fa-users"></i> الطلاب</a></li>
            @endhasanyrole
            @role('student')
            <li data-page="student"><a href="#"><i class="fas fa-users"></i> الطالب</a></li>
            @endrole
            @role('admin')
            <li data-page="teachers"><a href="#"><i class="fas fa-chalkboard-teacher"></i> إدارة المدرسين</a></li>
            <li data-page="parents"><a href="#"><i class="fas fa-user-friends"></i> أولياء الأمور</a></li>
            <li data-page="subjects"><a href="#"><i class="fas fa-book"></i> المواد الدراسية</a></li>
            <li data-page="events"><a href="#"><i class="fas fa-calendar-plus"></i> الأحداث</a></li>
            @endrole
            @hasanyrole(['admin', 'teacher', 'parent'])
            <li data-page="attendence"><a href="#"><i class="fas fa-user-check"></i> التفقد اليومي</a></li>
            @endrole
        </ul>
    </nav>
</aside>

