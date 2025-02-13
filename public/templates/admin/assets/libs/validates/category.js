document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll(".tablelist-form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      let isValid = true;

      // Lấy giá trị từ input trong form hiện tại
      const name = form.querySelector("[name='name']");

      // Reset thông báo lỗi trong form hiện tại
      form
        .querySelectorAll(".invalid-feedback")
        .forEach((el) => (el.style.display = "none"));
      form
        .querySelectorAll(".form-control")
        .forEach((el) => el.classList.remove("is-invalid"));

      // Kiểm tra name
      if (name.value.trim() === "") {
        showError(name, "Vui lòng nhập tên danh mục.");
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault(); // Ngăn chặn form submit nếu có lỗi
      }
    });
  });

  function showError(input, message) {
    const feedback = input.nextElementSibling;
    input.classList.add("is-invalid");
    feedback.innerText = message;
    feedback.style.display = "block";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".edit-item-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      let name = this.getAttribute("data-name");
      let status = this.getAttribute("data-status");

      // Gán dữ liệu vào form
      document.getElementById("id-field-edit").value = id;
      document.getElementById("name-field-edit").value = name;
      document.getElementById("status-field-edit").value = status || "0";

      // Cập nhật action của form để gửi đúng ID
      document
        .querySelector(".tablelist-form.edit")
        .setAttribute("action", `categories/${id}`);
    });
  });
});
