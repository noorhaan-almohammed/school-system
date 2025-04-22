<div id="add-parent-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-friends"></i> إضافة ولي أمر جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="parent-form">
            <div class="form-group">
                <label for="parent-name">اسم ولي الأمر</label>
                <input type="text" id="parent-name" placeholder="أدخل الاسم الكامل" required>
            </div>
            <div class="form-group">
                <label for="parent-email">البريد الإلكتروني</label>
                <input type="email" id="parent-email" placeholder="أدخل البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="parent-phone">رقم الهاتف</label>
                <input type="tel" id="parent-phone" placeholder="أدخل رقم الهاتف" required>
            </div>
            <div class="form-group">
                <label for="parent-relation">صلة القرابة</label>
                <select id="parent-relation" required>
                    <option value="father">الأب</option>
                    <option value="mother">الأم</option>
                    <option value="guardian">الوصي</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-warning">إضافة ولي الأمر</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any() && session('show_modal') === 'parent')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("add-parent-modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "false");
                modal.style.display = "flex";
            }
        });
    </script>
@endif
