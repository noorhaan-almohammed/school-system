<div id="add-parent-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-friends"></i> إضافة ولي أمر جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="parent-form" action="{{ route('createWebUser') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="parent-name">اسم ولي الأمر</label>
                <input type="text" id="parent-name" name="name" placeholder="أدخل الاسم الكامل" required>
                @error('name')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="parent-email">البريد الإلكتروني</label>
                <input type="email" id="parent-email" name="email" placeholder="أدخل البريد الإلكتروني" required>
                @error('email')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                @error('password')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="parent-phone">رقم الهاتف</label>
                <input type="tel" id="parent-phone" name="phone_number" placeholder="أدخل رقم الهاتف">
                @error('phone_number')
                <span class="error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <input type="hidden" id="role" name="role" value="parent" required>

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
