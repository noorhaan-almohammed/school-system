<div id="edit-teacher-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-chalkboard-teacher"></i> تعديل بيانات المدرس</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-teacher-form">
            <input type="hidden" id="edit-teacher-id">
            <div class="form-group">
                <label for="edit-teacher-name">اسم المدرس</label>
                <input type="text" id="edit-teacher-name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="edit-teacher-email">البريد الإلكتروني</label>
                <input type="email" id="edit-teacher-email" placeholder="أدخل البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="edit-teacher-phone">رقم الهاتف</label>
                <input type="tel" id="edit-teacher-phone" placeholder="أدخل رقم الهاتف" required>
            </div>
            <div class="form-group">
                <label for="edit-teacher-subject">المادة الدراسية</label>
                <select id="edit-teacher-subject" required>
                    <option value="">اختر المادة</option>
                    <option value="math">الرياضيات</option>
                    <option value="science">العلوم</option>
                    <option value="arabic">اللغة العربية</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
