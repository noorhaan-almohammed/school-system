<div id="edit-subject-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-book"></i> تعديل المادة الدراسية</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="edit-subject-form">
            <input type="hidden" id="edit-subject-id" name="id">

            <div class="form-group">
                <label for="edit-subject-name">اسم المادة</label>
                <input type="text" id="edit-subject-name" placeholder="أدخل اسم المادة" name="name" required>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
