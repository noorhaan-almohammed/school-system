<div id="student-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-user"></i> معلوماتك</h2>
        </div>
        <table class="data-table">
            <tbody>
                <tr>
                    <td><strong>الرقم:</strong></td>
                    <td> {{ 'S' . str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td><strong>الاسم:</strong></td>
                    <td> {{ $student->name }}</td>
                </tr>
                <tr>
                    <td><strong>البريد الإلكتروني:</strong></td>
                    <td> {{ $student->email }}</td>
                </tr>
                <tr>
                    <td><strong>رقم الهاتف:</strong></td>
                    <td> {{ $student->phone_number ?? '—' }}</td>
                </tr>
                <tr>
                    <td><strong>الصف:</strong></td>
                    <td> {{ $student->classRoom->name }}</td>
                </tr>
                <tr>
                    <td><strong>أولياء الأمور:</strong></td>
                    <td>
                        <ul>
                         @foreach ($student->parents as $parent)
                        <li>{{ $parent->name }}</li>
                    @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 class="sub-title">العلامات حسب المواد</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>المادة</th>
                    <th>الصف</th>
                    <th>العلامة</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->subjectPerformances as $performance)
                    <tr>
                        <td>{{ $performance->teachingAssignment->subject->name ?? '—' }}
                        </td>
                        <td>
                            {{ $performance->teachingAssignment->classroom->name ?? '—' }}</td>
                        <td>{{ $performance->grade }}</td>
                        <td>{{ $performance->comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="sub-title">الأداء العام</h3>
        <div class="bg-performance">
            {{ $student->overallPerformance->performance }}%
        </div>
    </div>
</div>
