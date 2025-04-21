<div id="subjects-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-book"></i> إدارة المواد الدراسية</h2>
            <button class="add-new-btn" id="add-subject-btn"><i class="fas fa-plus"></i> إضافة مادة
                جديدة</button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>كود المادة</th>
                    <th>اسم المادة</th>
                    <th>الصفوف</th>
                    <th>المدرس المسؤول</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use App\Models\Subject;

                    $subjects = Subject::with(['teachers', 'classes'])->get();
                @endphp
                @foreach ($subjects as $subject)
                    <tr data-modal="subject" data-id="{{ $subject->id }}">
                        <td>{{ 'Sub' . str_pad($subject->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            @foreach ($subject->classes as $class)
                                <div>{{ $class->name ?? '—' }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($subject->teachers as $teacher)
                                <div>{{ $teacher->name ?? '—' }}</div>
                            @endforeach
                        </td>
                        <td>
                            {{-- <button class="action-btn view-btn"><i class="fas fa-eye"></i></button> --}}
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
