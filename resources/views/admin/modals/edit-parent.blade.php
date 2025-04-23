<div id="edit-parent-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-friends"></i> تعديل بيانات ولي الأمر</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-parent-form">
            <input type="hidden" id="edit-parent-id" name="id">
            <div class="form-group">
                <label for="edit-parent-name">اسم ولي الأمر</label>
                <input type="text" id="edit-parent-name" name="name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="edit-parent-email">البريد الإلكتروني</label>
                <input type="email" id="edit-parent-email" name="email" placeholder="أدخل البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="edit-parent-phone">رقم الهاتف</label>
                <input type="tel" id="edit-parent-phone" name="phone_number" placeholder="أدخل رقم الهاتف" required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-warning">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
