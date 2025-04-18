<div id="add-subject-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-book"></i> إضافة مادة جديدة</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="subject-form">
            <div class="form-group">
                <label for="subject-name">اسم المادة</label>
                <input type="text" id="subject-name" placeholder="أدخل اسم المادة" required>
            </div>
            <div class="form-group">
                <label for="subject-code">كود المادة</label>
                <input type="text" id="subject-code" placeholder="أدخل كود المادة" required>
            </div>
            <div class="form-group">
                <label for="subject-grades">الصفوف</label>
                <select id="subject-grades" required>
                    <option value="">اختر الصف</option>
                    <option value="1">الصف الأول</option>
                    <option value="2">الصف الثاني</option>
                    <option value="3">الصف الثالث</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subject-teacher">المدرس المسؤول</label>
                <select id="subject-teacher" required>
                    <option value="">اختر المدرس</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة المادة</button>
            </div>
        </form>
    </div>
</div>
