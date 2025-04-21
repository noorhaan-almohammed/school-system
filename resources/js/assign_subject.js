document.addEventListener("DOMContentLoaded", function () {
    const assignForm = document.getElementById("assign-subject-form");
    const assignModal = document.getElementById("assign-subject-modal");

    if (!assignForm) return;

    assignForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(assignForm);
        const teacherId = formData.get("teacher_id");
        const url = `/teachers/${teacherId}/assign-subject`;

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": formData.get("_token"),
                Accept: "application/json",
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then((data) => {
                showAlert("success", data.message);
                closeModal(assignModal);
                assignForm.reset();

                // ابحث عن صف المدرس حسب الـ teacher_id
                const teacherRow = document.querySelector(
                    `tr[data-id="${formData.get("teacher_id")}"]`
                );
                if (teacherRow) {
                    const subjectCell =
                        teacherRow.querySelector("td:nth-child(4)");
                    const classCell =
                        teacherRow.querySelector("td:nth-child(5)");

                    const subjectDiv = document.createElement("div");
                    subjectDiv.setAttribute("data-assignment-id", data.assignment.id);
                    subjectDiv.classList.add("assignment");

                    subjectDiv.innerHTML = `
                        <span>${data.assignment.subject}</span>
                        <button class="delete-assignment" data-id="${data.assignment.id}">🗑️</button>
                    `;
                    subjectCell.appendChild(subjectDiv);

                    const classDiv = document.createElement("div");
                    classDiv.setAttribute(
                        "data-assignment-id",
                        data.assignment.id
                    );
                    classDiv.textContent = data.assignment.classroom;
                    classCell.appendChild(classDiv);
                }
            })
            .catch(async (err) => {
                let message = "حدث خطأ غير متوقع";
                if (err.status === 422) {
                    const errorData = await err.json();
                    if (errorData.errors) {
                        message = Object.values(errorData.errors)
                            .flat()
                            .join("<br>");
                    } else if (errorData.message) {
                        message = errorData.message; // ⬅️ هذا مهم للتكرار
                    }
                }
                showAlert("error", message);
            });
    });

    function closeModal(modal) {
        modal.setAttribute("aria-hidden", "true");
        modal.style.display = "none";
    }

    function showAlert(type, message) {
        const alert = document.createElement("div");
        alert.className = `alert ${
            type === "success" ? "alert-success" : "alert-danger"
        }`;
        alert.innerHTML = message;

        document.body.appendChild(alert);
        setTimeout(() => alert.classList.add("hide"), 3000);
        setTimeout(() => alert.remove(), 5500);
    }
    document.body.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-assignment")) {
            const id = e.target.dataset.id;
            const confirmed = confirm("هل أنت متأكد من حذف هذا الإسناد؟");

            if (!confirmed) return;

            fetch(`/assignments/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                },
            })
                .then((res) => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then((data) => {
                    showAlert("success", data.message);
                    document
                    .querySelectorAll(`[data-assignment-id="${id}"]`)
                    .forEach((el) => {
                        el.remove();
                    });
                })
                .catch(() => showAlert("error", "حدث خطأ أثناء الحذف"));
        }
        if (e.target.classList.contains("delete-btn")) {
            const id = e.target.dataset.id;
            const confirmed = confirm("هل أنت متأكد من حذف هذا المدرس");

            if (!confirmed) return;

            fetch(`/users/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                },
            })
                .then((res) => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then((data) => {
                    showAlert("success", data.message);
                    document
                    .querySelectorAll(`[data-id="${id}"]`)
                    .forEach((el) => {
                        el.remove();
                    });
                })
                .catch(() => showAlert("error", "حدث خطأ أثناء الحذف"));
        }
    });
});
