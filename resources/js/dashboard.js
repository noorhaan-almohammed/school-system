document.addEventListener('DOMContentLoaded', function() {
    // عناصر DOM الأساسية
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

    const forms = {
        student: document.getElementById('student-form'),
        teacher: document.getElementById('teacher-form'),
        parent: document.getElementById('parent-form'),
        subject: document.getElementById('subject-form'),
        event: document.getElementById('event-form'),
        editStudent: document.getElementById('edit-student-form'),
        editTeacher: document.getElementById('edit-teacher-form'),
        editParent: document.getElementById('edit-parent-form'),
        editSubject: document.getElementById('edit-subject-form')
    };

    // أحداث عامة
    document.querySelector('.nav-menu').addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link) e.preventDefault();

        const menuItem = e.target.closest('li');
        if (!menuItem) return;

        document.querySelectorAll('.nav-menu li, .page-content').forEach(el =>
            el.classList.remove('active'));

        menuItem.classList.add('active');
        document.getElementById(`${menuItem.getAttribute('data-page')}-page`).classList.add(
            'active');
    });

    document.addEventListener('click', function(e) {
        // فتح النماذج
        const addButtons = {
            'add-student-btn': 'student',
            'add-teacher-btn': 'teacher',
            'add-parent-btn': 'parent',
            'add-subject-btn': 'subject',
            'add-event-btn': 'event'
        };

        if (addButtons[e.target.id]) toggleModal(addButtons[e.target.id]);

        // إغلاق النماذج
        if (e.target.classList.contains('close-modal')) {
            e.target.closest('.modal').setAttribute('aria-hidden', 'true');
            e.target.closest('.modal').style.display = 'none';
        }

        // أحداث التعديل
        if (e.target.closest('.edit-btn')) handleEditClick(e);

        // ردود الرسائل
        if (e.target.classList.contains('reply-btn')) {
            const replySection = e.target.closest('.message-content').querySelector(
                '.message-reply');
            replySection.style.display = replySection.style.display === 'block' ? 'none' : 'block';
        }
    });

    // تأثيرات البطاقات
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

    // معالجة النماذج
    Object.entries(forms).forEach(([key, form]) => {
        if (form) form.addEventListener('submit', handleFormSubmit);
    });

    // تعبئة بيانات select
    populateSelect('student-parent', [{
            id: 1,
            name: 'أحمد محمد'
        },
        {
            id: 2,
            name: 'خالد عبدالله'
        },
        {
            id: 3,
            name: 'سعيد علي'
        }
    ]);

    populateSelect('subject-teacher', [{
            id: 1,
            name: 'خالد عبدالله'
        },
        {
            id: 2,
            name: 'سارة محمد'
        },
        {
            id: 3,
            name: 'علي حسن'
        }
    ]);

    // الدوال المساعدة
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

    function handleEditClick(e) {
        const row = e.target.closest('tr') || e.target.closest('.card');
        if (!row) return;

        const typeMap = {
            'students': 'student',
            'teachers': 'teacher',
            'parents': 'parent',
            'subjects': 'subject'
        };

        const type = Object.entries(typeMap).find(([key]) =>
            row.closest(`#${key}-table`) || row.closest(`#${key}-page`))?.[1];
        if (!type) return;

        const mockData = {
            id: row.getAttribute('data-id') || '1',
            name: 'اسم وهمي',
            ...getMockDataByType(type)
        };

        openEditModal(type, mockData);
    }

    function getMockDataByType(type) {
        const mockData = {
            student: {
                grade: '1',
                parentId: '1',
                birthdate: '2000-01-01'
            },
            teacher: {
                email: 'teacher@example.com',
                phone: '0512345678',
                subject: 'math'
            },
            parent: {
                email: 'parent@example.com',
                phone: '0512345678',
                relation: 'father'
            },
            subject: {
                code: 'MATH-101',
                grades: ['1', '2'],
                teacherId: '1'
            }
        };
        return mockData[type] || {};
    }

    function openEditModal(type, data) {
        toggleModal(`edit${type.charAt(0).toUpperCase() + type.slice(1)}`);

        const fields = {
            student: ['id', 'name', 'grade', 'parentId', 'birthdate'],
            teacher: ['id', 'name', 'email', 'phone', 'subject'],
            parent: ['id', 'name', 'email', 'phone', 'relation'],
            subject: ['id', 'name', 'code', 'teacherId']
        };

        fields[type]?.forEach(field => {
            const el = document.getElementById(`edit-${type}-${field}`);
            if (el) el.value = data[field];
        });

        if (type === 'subject' && data.grades) {
            const gradesSelect = document.getElementById('edit-subject-grades');
            Array.from(gradesSelect.options).forEach(opt => {
                opt.selected = data.grades.includes(opt.value);
            });
        }
    }

    function handleFormSubmit(e) {
        e.preventDefault();
        const isEdit = e.target.id.startsWith('edit-');
        const type = isEdit ? e.target.id.replace('edit-', '').replace('-form', '') :
            e.target.id.replace('-form', '');

        const id = isEdit ? document.getElementById(`edit-${type}-id`)?.value : '';
        alert(
            `${isEdit ? 'تم تحديث' : 'تمت إضافة'} ${getTypeName(type)}${isEdit ? ` (ID: ${id})` : ''} بنجاح!`
            );

        e.target.reset();
        toggleModal(null);
    }

    function getTypeName(type) {
        const names = {
            'student': 'طالب',
            'teacher': 'مدرس',
            'parent': 'ولي أمر',
            'subject': 'مادة دراسية',
            'event': 'حدث'
        };
        return names[type] || type;
    }

    function populateSelect(selectId, data) {
        const select = document.getElementById(selectId);
        if (!select) return;

        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            select.appendChild(option);
        });
    }
});

