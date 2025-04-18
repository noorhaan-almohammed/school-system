<div id="edit-subject-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-book"></i> تعديل المادة الدراسية</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-subject-form">
            <input type="hidden" id="edit-subject-id">
            <div class="form-group">
                <label for="edit-subject-name">اسم المادة</label>
                <input type="text" id="edit-subject-name" placeholder="أدخل اسم المادة" required>
            </div>
            <div class="form-group">
                <label for="edit-subject-code">كود المادة</label>
                <input type="text" id="edit-subject-code" placeholder="أدخل كود المادة" required>
            </div>

            <div class="form-group">
                <label for="edit-subject-grades">الصفوف</label>
                <select id="edit-subject-grades" multiple required>
                    <option value="1">الصف الأول</option>
                    <option value="2">الصف الثاني</option>
                    <option value="3">الصف الثالث</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-subject-teacher">المدرس المسؤول</label>
                <select id="edit-subject-teacher" required>
                    <option value="">اختر المدرس</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
