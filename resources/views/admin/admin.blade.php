<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>نظام إدارة المدرسة - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/dashboard.css'])
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="dashboard">
        <!-- الشريط الجانبي -->
        @include('admin.sidebar')
        <!-- المحتوى الرئيسي -->
        <main class="main-content">

            @include('admin.header')
            <!-- محتوى الصفحات -->
            @include('admin.contenet')
            <!-- صفحة الطلاب -->
            @hasanyrole(['admin', 'teacher', 'parent'])
                @include('admin.pages.students')
            @endrole
            @role('student')
                @php
                    $student = Auth::user()->load([
                        'subjectPerformances.teachingAssignment.subject',
                        'subjectPerformances.teachingAssignment.classroom',
                        'overallPerformance',
                        'parents',
                        'classRoom',
                    ]);
                @endphp
                @include('admin.pages.student')
            @endrole
            <!-- صفحة المدرسين -->
            @include('admin.pages.teachers')
            <!-- صفحة أولياء الأمور -->
            @role('admin')
                @include('admin.pages.parents')
            @endrole
            <!-- صفحة المواد الدراسية -->
            @include('admin.pages.subjects')
            <!-- صفحة الأحداث -->
            @include('admin.pages.events')
            @hasanyrole(['admin', 'teacher', 'parent'])
                @include('admin.pages.attendence')
            @endhasanyrole
        </main>
    </div>
    <!-- النماذج المنبثقة -->
    <!-- نموذج إضافة طالب -->
    @role('admin')
        @include('admin.modals.add-student')

        <!-- نموذج إضافة مدرس -->
        @include('admin.modals.add-teacher')

        @include('admin.modals.assign-class-subject')
        <!-- نموذج إضافة ولي أمر -->
        @include('admin.modals.add-parent')

        <!-- نموذج إضافة مادة دراسية -->
        @include('admin.modals.add-subject')

        <!-- نموذج إضافة حدث جديد -->
        @include('admin.modals.add-event')
        <!-- نماذج التعديل (تضاف بجانب نماذج الإضافة) -->
        <!-- نموذج تعديل طالب -->
        @include('admin.modals.edit-student')
        <!-- نموذج تعديل مدرس -->
        @include('admin.modals.edit-teacher')

        <!-- مودال إسناد طالب لولي أمر -->
        @include('admin.modals.assign-child')
        <!-- نموذج تعديل ولي أمر -->
        @include('admin.modals.edit-parent')
        <!-- نموذج تعديل مادة دراسية -->
        @include('admin.modals.edit-subject')
    @endrole
    @include('admin.modals.add-grad-studunt')

    @vite(['resources/js/modals_core.js', 'resources/js/modals_edit.js', 'resources/js/assign_subject.js', 'resources/js/assign_child.js', 'resources/js/add_grad.js'])

</body>

</html>
