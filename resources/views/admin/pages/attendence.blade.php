<div id="attendence-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            @php
            use Carbon\Carbon;
            $today = Carbon::today()->toDateString();
        @endphp

            @role('teacher')
            <h2 class="page-title"><i class="fas fa-users"></i> إدارة حضور الطلاب ليوم {{ $today }}</h2>
            @endrole
            @hasanyrole(['admin','parent'])
            <h2 class="page-title"><i class="fas fa-users"></i> الطلاب المتغيبون ليوم {{ $today }}</h2>
            @endrole
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الطالب</th>
                    <th>اسم الطالب</th>
                    <th>الصف</th>
                    @role('teacher')
                    <th>حالة الحضور</th>
                    @endrole
                </tr>
            </thead>
            <tbody>

                @if (auth()->user()->hasRole('admin'))
                    @php
                        $students = \App\Models\User::role('student')
                            ->where(function ($query) use ($today) {
                                $query
                                    ->whereDoesntHave('attendances', function ($q) use ($today) {
                                        $q->where('date', $today);
                                    })
                                    ->orWhereHas('attendances', function ($q) use ($today) {
                                        $q->where('date', $today)->where('status', 0);
                                    });
                            })
                            ->with(['parents', 'classRoom', 'attendances'])
                            ->whereHas('classRoom')
                            ->join('classrooms', 'users.class_id', '=', 'classrooms.id')
                            ->orderBy('classrooms.id')
                            ->select('users.*')
                            ->get();
                    @endphp
                @elseif (auth()->user()->hasRole('teacher'))
                    @php
                        $students = auth()
                            ->user()
                            ->students()
                            ->with(['classRoom', 'attendances'])
                            ->get();
                    @endphp
                @elseif (auth()->user()->hasRole('parent'))
                    @php
                        $parent = Auth::user();
                        $students = $parent
                            ->children()
                            ->where(function ($query) use ($today) {
                                $query
                                    ->whereDoesntHave('attendances', function ($q) use ($today) {
                                        $q->where('date', $today);
                                    })
                                    ->orWhereHas('attendances', function ($q) use ($today) {
                                        $q->where('date', $today)->where('status', 0);
                                    });
                            })
                            ->with(['parents', 'classRoom', 'attendances'])
                            ->whereHas('classRoom')
                            ->join('classrooms', 'users.class_id', '=', 'classrooms.id')
                            ->orderBy('classrooms.id')
                            ->select('users.*')
                            ->get();
                    @endphp
                @endif
                @if ($students->isEmpty())
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        <div style="
                            background-color: #f8f9fa;
                            color: #555;
                            padding: 15px;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                            font-size: 16px;
                        ">
                        ليس هناك طلاب متغيبون لهذا اليوم
                        </div>
                    </td>
                </tr>
            @endif

                @foreach ($students as $student)

                    <tr data-modal="student" data-id="{{ $student->id }}">
                        <td>{{ 'S' . str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->classRoom->name }}</td>
                        <td>
                            @php
                                $attendance = $student->attendances->firstWhere('date', $today);
                                $assignmentId = auth()
                                    ->user()
                                    ->teachingAssignments()
                                    ->where('class_id', $student->classRoom->id)
                                    ->first()?->id;

                            @endphp
                            @role('teacher')
                            <label class="attendance-switch">
                                <input type="checkbox"
                                       class="attendance-checkbox"
                                       data-student-id="{{ $student->id }}"
                                       data-assignment-id="{{ $assignmentId }}"
                                       {{ $attendance && $attendance->status ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            </td>
                        </tr>
                    @endrole
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
</div>

<div id="toast"
    style="display: none; position: fixed; top: 20px; right: 50%; background-color: #333; color: #fff;
            padding: 10px 20px; border-radius: 8px; z-index: 9999; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.attendance-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const studentId = this.getAttribute('data-student-id');
                const assignmentId = this.getAttribute('data-assignment-id');
                const isChecked = this.checked;

                fetch('/attendances/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            student_id: studentId,
                            status: isChecked ? 1 : 0,
                            teaching_assignment_id: assignmentId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            showToast('حدث خطأ أثناء تحديث الحضور', 'crimson');
                            checkbox.checked = !isChecked;
                        } else {
                            showToast('تم تحديث الحضور بنجاح', 'green');
                        }
                    })
                    .catch(error => {
                        showToast('فشل الاتصال بالسيرفر', 'crimson');
                        checkbox.checked = !isChecked;
                    });
            });
        });
    });

    function showToast(message, color = '#333') {
        const toast = document.getElementById('toast');
        toast.innerText = message;
        toast.style.backgroundColor = color;
        toast.style.display = 'block';

        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }
</script>
