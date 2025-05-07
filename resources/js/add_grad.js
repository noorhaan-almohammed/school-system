document.addEventListener("DOMContentLoaded", function () {
    const editModals = {
        editGrad: document.getElementById("edit-grad-student-modal"),
    };
    document.addEventListener("click", function (e) {
        if (e.target.closest(".grad-btn")) {
            const row = e.target.closest("tr");
            if (!row) return;

            const userId = row.getAttribute("data-id");

            fetch(`/users/${userId}/subject/class`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    document.getElementById("add-grad-student-id").value = data.id;
                    document.getElementById("add-grad-student-name").value =
                        data.name;

                    const tbody = document.querySelector("#grades-table tbody");
                    tbody.innerHTML = "";

                    data.subject_performances.forEach((performance) => {
                        const subject = performance.teaching_assignment.subject; // "التربية الدينية"
                        const classroom =
                            performance.teaching_assignment.classroom; // "الصف السادس"
                        const grade = performance.grade || ""; // null => ''
                        const comment = performance.comment || ""; // undefined => ''
                        const taId = performance.teaching_assignment_id; // 6

                        const row = document.createElement("tr");
                        row.innerHTML = `
                        <td>${subject}</td>
                        <td>${classroom}</td>
                        <td><input type="number" name="grades[${taId}][grade]" value="${grade}" min="0" max="100" required></td>
                        <td><input type="text" name="grades[${taId}][comment]" value="${comment}" placeholder="ملاحظة (اختياري)"></td>
                    `;

                        tbody.appendChild(row);
                    });

                    toggleEditModal("editGrad");
                })
                .catch((error) => {
                    alert("حدث خطأ أثناء جلب بيانات الطالب");
                    console.error(error);
                });
        }
    });

    // إرسال الفورم عبر Ajax
    document
        .getElementById("edit-grad-student-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("/student/grades/update", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: formData,
            })
                .then((res) => res.json())
                .then((data) => {

                    const modal = document.getElementById("edit-grad-student-modal");
                    modal.setAttribute("aria-hidden", "true");
                    modal.style.display = "none";

                    alert(data.message);

                })
                .catch((err) => {
                    alert("حدث خطأ أثناء الحفظ");
                    console.error(err);
                });
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
});
