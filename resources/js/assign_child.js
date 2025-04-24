document.addEventListener("DOMContentLoaded", function () {
    const assignChildForm = document.getElementById("assign-student-form");
    const assignChildModal = document.getElementById("assign-student-modal");

    // حفظ معرف ولي الأمر المستهدف
    let selectedParentId = null;

    // فتح المودال وتحديد parent_id
    document.querySelectorAll(".view-add-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const parentRow = btn.closest("tr");
            selectedParentId = parentRow.dataset.id;

            assignChildModal.style.display = "flex";
            assignChildModal.setAttribute("aria-hidden", "false");
        });
    });

    // غلق المودال
    document.querySelectorAll(".close-modal").forEach((btn) => {
        btn.addEventListener("click", function () {
            closeModal(assignChildModal);
        });
    });

    // إرسال الفورم
    assignChildForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(assignChildForm);
        const url = `/parent/${selectedParentId}/assign-child`;

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                Accept: "application/json",
            },
            body: formData,
        })
            .then((res) => {
                if (!res.ok) throw res;
                return res.json();
            })
            .then((data) => {
                showAlert("success", data.message);
                closeModal(assignChildModal);
                assignChildForm.reset();

                // تحديث العمود الخاص بالأبناء
                const parentRow = document.querySelector(`tr[data-id="${selectedParentId}"]`);
                const childrenCell = parentRow.querySelector("td:nth-child(3)");

                const childDiv = document.createElement("div");
                childDiv.classList.add("child");
                childDiv.setAttribute("data-child-id", data.child.id);
                childDiv.innerHTML = `
                    ${data.child.name}
                    <button class="delete-child" data-id="${data.assignment_id}">🗑️</button>
                `;

                childrenCell.appendChild(childDiv);
            })
            .catch(async (err) => {
                let message = "حدث خطأ غير متوقع";

                try {
                    const errorData = await err.json();
                    message = errorData.message || Object.values(errorData.errors || {}).flat().join("<br>");
                } catch (e) {
                    console.error("خطأ أثناء تحليل الخطأ:", e);
                }

                showAlert("error", message);
            });
    });

    // حذف الطفل من ولي الأمر
    document.body.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-child")) {
            const assignmentId = e.target.dataset.id;
            const confirmed = confirm("هل أنت متأكد من حذف هذا الطالب من قائمة الأبناء؟");
            if (!confirmed) return;

            fetch(`/children/${assignmentId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    Accept: "application/json",
                },
            })
                .then((res) => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then((data) => {
                    showAlert("success", data.message);
                    e.target.closest(".child").remove();
                })
                .catch(() => {
                    showAlert("error", "حدث خطأ أثناء الحذف");
                });
        }
    });

    function closeModal(modal) {
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
    }

    function showAlert(type, message) {
        const alert = document.createElement("div");
        alert.className = `alert ${type === "success" ? "alert-success" : "alert-danger"}`;
        alert.innerHTML = message;
        document.body.appendChild(alert);
        setTimeout(() => alert.classList.add("hide"), 3000);
        setTimeout(() => alert.remove(), 5500);
    }
});
