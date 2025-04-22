<div id="add-event-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-calendar-plus"></i> إضافة حدث جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="event-form">
            <div class="form-group">
                <label for="event-title">عنوان الحدث</label>
                <input type="text" id="event-title" placeholder="أدخل عنوان الحدث" required>
            </div>
            <div class="form-group">
                <label for="event-date">تاريخ الحدث</label>
                <input type="date" id="event-date" required>
            </div>
            <div class="form-group">
                <label for="event-time">وقت الحدث</label>
                <input type="time" id="event-time" required>
            </div>
            <div class="form-group">
                <label for="event-duration">مدة الحدث (ساعات)</label>
                <input type="number" id="event-duration" min="1" max="8" value="1"
                    required>
            </div>
            <div class="form-group">
                <label for="event-description">وصف الحدث</label>
                <textarea id="event-description" placeholder="أدخل وصفاً للحدث"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة الحدث</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any() && session('show_modal') === 'event')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("add-event-modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "false");
                modal.style.display = "flex";
            }
        });
    </script>
@endif
