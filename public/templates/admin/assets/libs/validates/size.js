document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".tablelist-form");

    const sizes = window.sizes || [];

    console.log(sizes);

    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            let isValid = true;

            // Lấy giá trị từ input trong form hiện tại
            const size = form.querySelector("[name='size']");
            const id = form.querySelector("[name='id']").value;
            // console.log(idSize);

            const slugSize = createSlug(size.value);
            console.log(slugSize);

            // Reset thông báo lỗi trong form hiện tại
            form.querySelectorAll(".invalid-feedback").forEach(
                (el) => (el.style.display = "none")
            );
            form.querySelectorAll(".form-control").forEach((el) =>
                el.classList.remove("is-invalid")
            );

            if (sizes.some((size) => size.slug === slugSize && size.id != id)) {
                showError(size, "Kích cỡ đã tồn tại");
                isValid = false;
            }

            // Kiểm tra size nếu có
            if (size && size.value.trim() === "") {
                showError(size, "Vui lòng nhập tên kích cỡ.");
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
            if (this.hasAttribute("data-size")) {
                let size = this.getAttribute("data-size");
                document.getElementById("id-field-edit-size").value = id;
                document.getElementById("size-field-edit").value = size;
                document
                    .querySelector(".tablelist-form.edit-size")
                    .setAttribute("action", `attributes/size/${id}`);
            }
        });
    });
});

