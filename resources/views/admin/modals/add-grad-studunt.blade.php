<div id="edit-grad-student-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-user-graduate"></i> درجات الطالب</h3>
            <button class="close-modal">&times;</button>
        </div>

        <form id="edit-grad-student-form" method="POST" action="javascript:void(0);">
            @csrf
            <input type="hidden" id="add-grad-student-id" name="id">

            <div class="form-group">
                <label for="add-grad-student-name">اسم الطالب</label>
                <input type="text" id="add-grad-student-name" name="name" readonly>
            </div>

            <div class="form-group">
                <label>المواد والدرجات</label>
                <table class="table" id="grades-table">
                    <thead>
                        <tr>
                            <th>المادة</th>
                            <th>الصف</th>
                            <th>الدرجة</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="form-group" >
                <label for="overallPerformance">المعدل المهائي</label>
                <input type="text" id="overallPerformance" name="overallPerformance" readonly>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary close-modal">إغلاق</button>
                @role('teacher')
                <button type="submit" class="btn btn-primary">حفظ</button>
                @endrole
            </div>
        </form>
    </div>
</div>
