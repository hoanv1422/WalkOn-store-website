document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll(".tablelist-form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      let isValid = true;

      // Lấy input trong form hiện tại
      const name = form.querySelector("[name='name']");
      const status = form.querySelector("[name='is_active']");

      // Reset lỗi trong form hiện tại
      form
        .querySelectorAll(".invalid-feedback")
        .forEach((el) => (el.style.display = "none"));
      form
        .querySelectorAll(".form-control")
        .forEach((el) => el.classList.remove("is-invalid"));

      // Kiểm tra name
      if (name && name.value.trim() === "") {
        showError(name, "Vui lòng nhập tên thương hiệu.");
        isValid = false;
      }

      // Kiểm tra trạng thái
      if (status && status.value === "") {
        showError(status, "Vui lòng chọn trạng thái.");
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault(); // Ngăn submit nếu có lỗi
      }
    });
  });

  function showError(input, message) {
    if (!input) return;
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
      let logo = this.getAttribute("data-logo");
      let name = this.getAttribute("data-name");
      let description = this.getAttribute("data-description");
      let status = this.getAttribute("data-status");

      // Gán dữ liệu vào form
      document.getElementById("id-field-edit").value = id;
      document.getElementById("name-field-edit").value = name;
      document.getElementById("description-field-edit").value = description;
      document.getElementById("product-img-edit").src = logo;
      document.getElementById("status-field-edit").value = status || "0";


      // Cập nhật action của form để gửi đúng ID
      document
        .querySelector(".tablelist-form.edit")
        .setAttribute("action", `brands/${id}`);
    });
  });
});
