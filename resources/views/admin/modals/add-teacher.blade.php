<div id="add-teacher-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-chalkboard-teacher"></i> إضافة مدرس جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="teacher-form">
            <div class="form-group">
                <label for="teacher-name">اسم المدرس</label>
                <input type="text" id="teacher-name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="teacher-email">البريد الإلكتروني</label>
                <input type="email" id="teacher-email" placeholder="أدخل البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="teacher-phone">رقم الهاتف</label>
                <input type="tel" id="teacher-phone" placeholder="أدخل رقم الهاتف" required>
            </div>
            <div class="form-group">
                <label for="teacher-subject">المادة الدراسية</label>
                <select id="teacher-subject" required>
                    <option value="">اختر المادة</option>
                    <option value="math">الرياضيات</option>
                    <option value="science">العلوم</option>
                    <option value="arabic">اللغة العربية</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة المدرس</button>
            </div>
        </form>
    </div>
</div>
