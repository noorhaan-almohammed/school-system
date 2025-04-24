<div id="edit-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-graduate"></i> تعديل بيانات الطالب</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-student-form" method="POST">
            @csrf
            <input type="hidden" id="edit-student-id" name="id">
            <div class="form-group">
                <label for="edit-student-name">اسم الطالب</label>
                <input type="text" id="edit-student-name" name="name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="edit-student-email">البريد الإلكتروني</label>
                <input type="email" id="edit-student-email" name="email" placeholder="أدخل البريد الإلكتروني"
                    required>
            </div>
            <div class="form-group">
                <label for="edit-student-phone">رقم الهاتف</label>
                <input type="tel" id="edit-student-phone" name="phone_number" placeholder="أدخل رقم الهاتف">
            </div>
            <div class="form-group">
                <label for="edit-student-class">الصف الدراسي</label>
                <select id="edit-student-class" name="class_id" required>
                    @php
                        $classes = \app\Models\Classroom::get();
                    @endphp
                    @foreach ($classes as $class)
                       <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
