<div id="add-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-graduate"></i> إضافة طالب جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="student-form" action="{{ route('createWebUser') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="student-name">اسم الطالب</label>
                <input type="text" id="student-name" name="name" placeholder="أدخل الاسم الكامل" required>
                @error('name')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="student-grade">الصف الدراسي</label>
                <select id="student-grade" name="class_id" required>
                    @php
                        $classes = \app\Models\Classroom::get();
                    @endphp
                    @foreach ($classes as $class)
                        <option value={{ $class->id }}>{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="student-parent">ولي الأمر</label>
                <select id="student-parent" name="parent_id">
                    @php
                        $parents = \app\Models\User::role('parent')->get();
                    @endphp
                    <option value="">اختر ولي الأمر</option>
                    @foreach ($parents as $parent)
                        <option value={{ $parent->id }}>{{ $parent->name }}</option>
                    @endforeach
                </select>
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
                <input type="tel" id="teacher-phone" name="phone_number" placeholder="أدخل رقم الهاتف" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="hidden" id="role" name="role" value="student" required>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة الطالب</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any() && session('show_modal') === 'student')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("add-student-modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "false");
                modal.style.display = "flex";
            }
        });
    </script>
@endif
