<div id="students-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-users"></i> إدارة الطلاب</h2>
            <button class="add-new-btn" id="add-student-btn"><i class="fas fa-plus"></i> إضافة طالب
                جديد</button>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الطالب</th>
                    <th>اسم الطالب</th>
                    <th>البريد الالكتروني</th>
                    <th>رقم الهاتف</th>
                    <th>الصف</th>
                    <th>ولي الأمر</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @if (auth()->user()->hasRole('admin'))
                    @php
                        $students = \App\Models\User::role('student')
                            ->with(['parents', 'classRoom'])
                            ->get();
                    @endphp
                @elseif (auth()->user()->hasRole('teacher'))
                    @php
                        $students = auth()->user()->students()->get();
                    @endphp
                @elseif (auth()->user()->hasRole('parent'))
                    @php
                        $parent = Auth::user();
                        $students = $parent
                            ->children()
                            ->with(['classRoom', 'parents'])
                            ->get();
                    @endphp
                @endif
                @foreach ($students as $student)
                    <tr data-modal="student" data-id="{{ $student->id }}">
                        <td>{{ 'S' . str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone_number ?? '—' }}</td>
                        <td>{{ $student->classRoom->name }}</td>
                        <td>
                            @foreach ($student->parents as $parent)
                                <div>{{ $parent->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            <button class="action-btn grad-btn bg-green"><i class="fas fa-clipboard-list"></i></button>
                            @role('admin')
                            <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete-btn" data-id="{{ $student->id }}"><i
                                    class="fas fa-trash"></i></button>
                                    @endrole
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
