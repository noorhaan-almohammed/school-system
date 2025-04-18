<div id="edit-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-graduate"></i> تعديل بيانات الطالب</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-student-form">
            <input type="hidden" id="edit-student-id">
            <div class="form-group">
                <label for="edit-student-name">اسم الطالب</label>
                <input type="text" id="edit-student-name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="edit-student-grade">الصف الدراسي</label>
                <select id="edit-student-grade" required>
                    <option value="">اختر الصف</option>
                    <option value="1">الصف الأول</option>
                    <option value="2">الصف الثاني</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-student-parent">ولي الأمر</label>
                <select id="edit-student-parent" required>
                    <option value="">اختر ولي الأمر</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-student-birthdate">تاريخ الميلاد</label>
                <input type="date" id="edit-student-birthdate" required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
