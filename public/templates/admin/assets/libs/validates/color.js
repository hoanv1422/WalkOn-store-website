document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".tablelist-form");

    const colors = window.colors || [];

    console.log(colors);

    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            let isValid = true;

            // Lấy giá trị từ input trong form hiện tại
            const color = form.querySelector("[name='color']");
            const id = form.querySelector("[name='id']").value;

            const slugColor = createSlug(color.value);

            // Reset thông báo lỗi trong form hiện tại
            form.querySelectorAll(".invalid-feedback").forEach(
                (el) => (el.style.display = "none")
            );
            form.querySelectorAll(".form-control").forEach((el) =>
                el.classList.remove("is-invalid")
            );

            // Kiểm tra color nếu có
            if (color && color.value.trim() === "") {
                showError(color, "Vui lòng nhập tên màu sắc.");
                isValid = false;
            }

            if (
                colors.some(
                    (color) => color.slug === slugColor && color.id != id
                )
            ) {
                showError(color, "Màu đã tồn tại");
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Ngăn chặn form submit nếu có lỗi
            }
        });
    });

    function showError(input, message) {
        const feedback = input.nextElementSibling;
        if (feedback) {
            input.classList.add("is-invalid");
            feedback.innerText = message;
            feedback.style.display = "block";
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-item-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");

            // Kiểm tra nếu là chỉnh sửa màu sắc
            if (this.hasAttribute("data-color")) {
                let color = this.getAttribute("data-color");
                document.getElementById("id-field-edit-color").value = id;
                document.getElementById("color-field-edit").value = color;
                document
                    .querySelector(".tablelist-form.edit-color")
                    .setAttribute("action", `attributes/color/${id}`);
            }
        });
    });
});
