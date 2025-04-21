<!-- مودال إسناد مادة وصف لمعلم -->
<div id="assign-subject-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-book"></i> إسناد مادة وصف لمعلم</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="assign-subject-form" method="POST">
            @csrf
            @php
                use App\Models\Subject;
                use App\Models\ClassRoom;
                $subjects = Subject::get();
                $classrooms = ClassRoom::get();
            @endphp
            <input type="hidden" id="assign-teacher-id" name="teacher_id">
            <div class="form-group">
                <label for="subject">اختر المادة</label>
                <select id="subject" name="subject_id" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="classroom">اختر الصف</label>
                <select id="classroom" name="classroom_id" required>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إسناد</button>
            </div>
        </form>
    </div>
</div>
