<!-- مودال إسناد طالب لولي أمر -->
<div id="assign-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-book"></i> إسناد طالب لولي أمر</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="assign-student-form" method="POST">
            @csrf
            @php
                use App\Models\User;
                $students = User::role('student')->get();
            @endphp
            <input type="hidden" id="assign-student-id" name="child_id">
            <div class="form-group">
                <label for="student">اختر الطالب</label>
                <select id="student" name="child_id" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة</button>
            </div>
        </form>
    </div>
</div>
