// modals-core.js
document.addEventListener('DOMContentLoaded', function () {
    const modals = {
        student: document.getElementById('add-student-modal'),
        teacher: document.getElementById('add-teacher-modal'),
        parent: document.getElementById('add-parent-modal'),
        subject: document.getElementById('add-subject-modal'),
        event: document.getElementById('add-event-modal'),
    };

    // حفظ التوغل لتستخدمه الملفات الأخرى
    window.toggleModal = function (modalType) {
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

    // فتح مودالات الإضافة + إغلاق
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
            const modal = e.target.closest('.modal');
            modal.setAttribute('aria-hidden', 'true');
            modal.style.display = 'none';
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

    // تنبيهات fade out
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => alert.classList.add('hide'), 3000);
        setTimeout(() => alert.remove(), 5500);
    });

    // تفعيل مودال الخطأ إذا كان فيه رسالة
    const loginError = document.querySelector('.modal .login-error');
    if (loginError) {
        const modal = loginError.closest('.modal');
        modal.setAttribute('aria-hidden', 'false');
        modal.style.display = 'flex';
    }
});
