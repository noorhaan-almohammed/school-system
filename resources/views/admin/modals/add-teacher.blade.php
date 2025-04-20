<div id="add-teacher-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-chalkboard-teacher"></i> إضافة مدرس جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="teacher-form" action="{{ route('createWebUser') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="teacher-name">اسم المدرس</label>
                <input type="text" id="teacher-name" name="name" placeholder="أدخل الاسم الكامل" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="teacher-email">البريد الإلكتروني</label>
                <input type="email" id="teacher-email" name="email" placeholder="أدخل البريد الإلكتروني" value="{{ old('email') }}" required>
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
                <label for="teacher-phone">رقم الهاتف</label>
                <input type="tel" id="teacher-phone" name="phone_number" placeholder="أدخل رقم الهاتف" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="hidden" id="role" name="role" value="teacher" required>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة المدرس</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // فتح مودال المدرس إذا كان فيه أخطاء تحقق
            const modal = document.getElementById("add-teacher-modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "false");
                modal.style.display = "flex";
            }
        });
    </script>
@endif
