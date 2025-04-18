<div id="add-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-graduate"></i> إضافة طالب جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="student-form">
            <div class="form-group">
                <label for="student-name">اسم الطالب</label>
                <input type="text" id="student-name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="student-grade">الصف الدراسي</label>
                <select id="student-grade" required>
                    <option value="">اختر الصف</option>
                    <option value="1">الصف الأول</option>
                    <option value="2">الصف الثاني</option>
                </select>
            </div>
            <div class="form-group">
                <label for="student-parent">ولي الأمر</label>
                <select id="student-parent" required>
                    <option value="">اختر ولي الأمر</option>
                </select>
            </div>
            <div class="form-group">
                <label for="student-birthdate">تاريخ الميلاد</label>
                <input type="date" id="student-birthdate" required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة الطالب</button>
            </div>
        </form>
    </div>
</div>
