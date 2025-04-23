document.addEventListener("DOMContentLoaded", function () {
    const editModals = {
        editStudent: document.getElementById("edit-student-modal"),
        editTeacher: document.getElementById("edit-teacher-modal"),
        editParent: document.getElementById("edit-parent-modal"),
        editSubject: document.getElementById("edit-subject-modal"),
    };

    document.addEventListener("click", function (e) {
        // إغلاق المودال عند الضغط على زر الإغلاق
        if (e.target.classList.contains("close-modal")) {
            const modal = e.target.closest(".modal");
            if (modal) {
                modal.setAttribute("aria-hidden", "true");
                modal.style.display = "none";
            }
        }

        // عند الضغط على زر تعديل
        if (e.target.closest(".edit-btn")) {
            const row = e.target.closest("tr");
            if (!row) return;

            const modalType = row.getAttribute("data-modal");
            if (modalType == "teacher") {
                const userId = row.getAttribute("data-id");
                fetch(`/users/${userId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("edit-teacher-id").value =
                            data.id;
                        document.getElementById("edit-teacher-name").value =
                            data.name;
                        document.getElementById("edit-teacher-email").value =
                            data.email;
                        document.getElementById("edit-teacher-phone").value =
                            data.phone_number || "";
                        toggleEditModal("editTeacher");
                    })
                    .catch((error) => {
                        alert("حدث خطأ أثناء جلب بيانات المعلم");
                        console.error(error);
                    });
            }
            if (modalType == "parent") {
                const userId = row.getAttribute("data-id");
                fetch(`/users/${userId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("edit-parent-id").value =
                            data.id;
                        document.getElementById("edit-parent-name").value =
                            data.name;
                        document.getElementById("edit-parent-email").value =
                            data.email;
                        document.getElementById("edit-parent-phone").value =
                            data.phone_number || "";
                        toggleEditModal("editParent");
                    })
                    .catch((error) => {
                        alert("حدث خطأ أثناء جلب بيانات ولي الأمر");
                        console.error(error);
                    });
            }
            if (modalType == "subject") {
                const subjectId = row.getAttribute("data-id");
                fetch(`/subject/${subjectId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("edit-subject-id").value =
                            data.id;
                        document.getElementById("edit-subject-name").value =
                            data.name;
                        toggleEditModal("editSubject");
                    })
                    .catch((error) => {
                        alert("حدث خطأ أثناء جلب بيانات المادة");
                        console.error(error);
                    });
            }
        }
    });

    function toggleEditModal(modalType) {
        Object.values(editModals).forEach((m) => {
            if (m) {
                m.setAttribute("aria-hidden", "true");
                m.style.display = "none";
            }
        });

        if (modalType && editModals[modalType]) {
            editModals[modalType].setAttribute("aria-hidden", "false");
            editModals[modalType].style.display = "flex";
        }
    }

    // تحديث بيانات المعلم عند حفظ التعديلات
    const editTeacherForm = document.getElementById("edit-teacher-form");
    editTeacherForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("edit-teacher-id").value;
        const formData = new FormData(this);

        fetch(`/users/${id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then((data) => {
                // تحديث البيانات في السطر مباشرة
                const teacherRow = document.querySelector(
                    `tr[data-id="${id}"]`
                );
                if (teacherRow) {
                    teacherRow.querySelector("td:nth-child(2)").textContent =
                        data.name;
                    teacherRow.querySelector("td:nth-child(3)").textContent =
                        data.email;
                    teacherRow.querySelector("td:nth-child(6)").textContent =
                        data.phone_number;

                    // إغلاق المودال
                    const modal = document.getElementById("edit-teacher-modal");
                    modal.setAttribute("aria-hidden", "true");
                    modal.style.display = "none";
                }

                alert("تم تحديث بيانات المدرس بنجاح");
            })
            .catch(async (error) => {
                if (error.status === 422) {
                    const res = await error.json();
                    alert(Object.values(res.errors).join("\n"));
                } else {
                    alert("حدث خطأ أثناء التحديث");
                    console.error(error);
                }
            });
    });

    // تحديث بيانات المادة عند حفظ التعديلات
    const editSubjectForm = document.getElementById("edit-subject-form");
    editSubjectForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("edit-subject-id").value;
        const formData = new FormData(this);

        fetch(`/subject/${id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then((data) => {
                // تحديث البيانات في السطر مباشرة
                const subjectRow = document.querySelector(
                    `tr[data-id="${id}"]`
                );
                if (subjectRow) {
                    subjectRow.querySelector("td:nth-child(2)").textContent =
                        data.name;
                    // إغلاق المودال
                    const modal = document.getElementById("edit-subject-modal");
                    modal.setAttribute("aria-hidden", "true");
                    modal.style.display = "none";
                }

                alert("تم تحديث بيانات المادة بنجاح");
            })
            .catch(async (error) => {
                if (error.status === 422) {
                    const res = await error.json();
                    alert(Object.values(res.errors).join("\n"));
                } else {
                    alert("حدث خطأ أثناء التحديث");
                    console.error(error);
                }
            });
    });

    // تحديث بيانات ولي الأمر عند حفظ التعديلات
    const editParenttForm = document.getElementById("edit-parent-form");
    editParenttForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("edit-parent-id").value;
        const formData = new FormData(this);

        fetch(`/users/${id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then((data) => {
                // تحديث البيانات في السطر مباشرة
                const parentRow = document.querySelector(`tr[data-id="${id}"]`);
                if (parentRow) {
                    parentRow.querySelector("td:nth-child(2)").textContent =
                        data.name;
                    parentRow.querySelector("td:nth-child(5)").textContent =
                        data.email;
                    parentRow.querySelector("td:nth-child(4)").textContent =
                        data.phone_number || "";

                    // إغلاق المودال
                    const modal = document.getElementById("edit-parent-modal");
                    modal.setAttribute("aria-hidden", "true");
                    modal.style.display = "none";
                }

                alert("تم تحديث بيانات ولي الأمر بنجاح");
            })
            .catch(async (error) => {
                if (error.status === 422) {
                    const res = await error.json();
                    alert(Object.values(res.errors).join("\n"));
                } else {
                    alert("حدث خطأ أثناء التحديث");
                    console.error(error);
                }
            });
    });
});
