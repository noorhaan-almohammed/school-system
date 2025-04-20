document.addEventListener('DOMContentLoaded', function () {
    const modals = {
        student: document.getElementById('add-student-modal'),
        teacher: document.getElementById('add-teacher-modal'),
        parent: document.getElementById('add-parent-modal'),
        subject: document.getElementById('add-subject-modal'),
        event: document.getElementById('add-event-modal'),
        editStudent: document.getElementById('edit-student-modal'),
        editTeacher: document.getElementById('edit-teacher-modal'),
        editParent: document.getElementById('edit-parent-modal'),
        editSubject: document.getElementById('edit-subject-modal')
    };

    // تنقل الصفحات
    document.querySelector('.nav-menu').addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (link) e.preventDefault();

        const menuItem = e.target.closest('li');
        if (!menuItem) return;

        document.querySelectorAll('.nav-menu li, .page-content').forEach(el =>
            el.classList.remove('active'));

        menuItem.classList.add('active');
        document.getElementById(`${menuItem.getAttribute('data-page')}-page`).classList.add('active');
    });

    // فتح وإغلاق النماذج
    document.addEventListener('click', function (e) {
        const addButtons = {
            'add-student-btn': 'student',
            'add-teacher-btn': 'teacher',
            'add-parent-btn': 'parent',
            'add-subject-btn': 'subject',
            'add-event-btn': 'event'
        };

        if (addButtons[e.target.id]) toggleModal(addButtons[e.target.id]);

        if (e.target.classList.contains('close-modal')) {
            e.target.closest('.modal').setAttribute('aria-hidden', 'true');
            e.target.closest('.modal').style.display = 'none';
        }
        // معالجة أحداث التعديل
        if (e.target.closest('.edit-btn')) {
            const row = e.target.closest('tr');
            if (!row) return;
            // فتح النموذج
            toggleModal('editTeacher');
        }
    });

    // تأثير hover على الكروت
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
        });
    });

    // ✅ سكريبت التنبيه هنا (خارج أي DOMContentLoaded ثاني)
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('hide');
        }, 5000); // بعد 5 ثواني

        // إزالة التنبيه من DOM بعد الانيميشن
        setTimeout(() => {
            alert.remove();
        }, 5500);
    });

    // تفعيل مودال الخطأ إذا وُجد
    if (document.querySelector('.modal .login-error')) {
        const modal = document.querySelector('.modal .login-error').closest('.modal');
        if (modal) {
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'flex';
        }
    }

    function toggleModal(modalType) {
        Object.values(modals).forEach(m => {
            if (m) {
                m.setAttribute('aria-hidden', 'true');
                m.style.display = 'none';
            }
        });

        if (modalType && modals[modalType]) {
            modals[modalType].setAttribute('aria-hidden', 'false');
            modals[modalType].style.display = 'flex';
        }
    }
});
