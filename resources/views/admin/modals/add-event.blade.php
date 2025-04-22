<div id="add-event-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-calendar-plus"></i> إضافة حدث جديد</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form id="event-form" action="{{ route('createEvent') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="event-title">عنوان الحدث</label>
                <input type="text" id="event-title" name="title" value="{{ old('title') }}" placeholder="أدخل عنوان الحدث">
                @error('title')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event-date">تاريخ الحدث</label>
                <input type="date" id="event-date" name="date" value="{{ old('date') }}">
                @error('date')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event-time">وقت الحدث</label>
                <input type="time" id="event-time" name="time" value="{{ old('time') }}">
                @error('time')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event-duration">مدة الحدث (ساعات)</label>
                <input type="number" id="event-duration" name="duration" value="{{ old('duration') }}" value="1">
                @error('duration')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event-description">وصف الحدث</label>
                <textarea id="event-description" name="description" value="{{ old('description') }}" placeholder="أدخل وصفاً للحدث"></textarea>
            </div>
            @error('description')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">إضافة الحدث</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any() && session('show_modal') === 'event')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("add-event-modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "false");
                modal.style.display = "flex";
            }
        });
    </script>
@endif
