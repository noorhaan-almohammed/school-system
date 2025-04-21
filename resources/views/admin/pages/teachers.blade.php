<div id="teachers-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-chalkboard-teacher"></i> إدارة المدرسين</h2>
            <button class="add-new-btn" id="add-teacher-btn"><i class="fas fa-plus"></i> إضافة مدرس
                جديد</button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الموظف</th>
                    <th>اسم المدرس</th>
                    <th>البريد الالكتروني</th>
                    <th>المادة</th>
                    <th>الصف</th>
                    <th>رقم الهاتف</th>
                    {{-- <th>الحالة</th> --}}
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use App\Models\User;

                    $teachers = User::role('teacher')
                        ->with(['teachingAssignments.subject', 'teachingAssignments.classroom'])
                        ->get();
                @endphp

                @foreach ($teachers as $teacher)
                    <tr data-modal="teacher" data-id="{{ $teacher->id }}">
                        <td>{{ 'T' . str_pad($teacher->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            @foreach ($teacher->teachingAssignments as $assignment)
                                <div data-assignment-id="{{ $assignment->id }}">
                                    {{ $assignment->subject->name ?? '—' }}
                                    <button class="delete-assignment" data-id="{{ $assignment->id }}">🗑️</button>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($teacher->teachingAssignments as $assignment)
                                <div data-assignment-id="{{ $assignment->id }}">
                                    {{ $assignment->classroom->name ?? '—' }}
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($teacher->teachingAssignments as $assignment)
                                <div>{{ $assignment->classroom->name ?? '—' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $teacher->phone_number ?? '—' }}</td>
                        <td>
                            <button class="action-btn view-btn"><i class="fas fa-plus"></i></button>
                            <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
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
