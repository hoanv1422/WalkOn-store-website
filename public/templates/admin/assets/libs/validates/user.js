document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll(".tablelist-form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      let isValid = true;

      // Lấy input trong form hiện tại
      const username = form.querySelector("[name='username']");
      const email = form.querySelector("[name='mail']");
      const password = form.querySelector("[name='password']");
      const phone = form.querySelector("[name='phone']");
      const address = form.querySelector("[name='address']");
      const status = form.querySelector("[name='is_active']");

      // Reset lỗi trong form hiện tại
      form
        .querySelectorAll(".invalid-feedback")
        .forEach((el) => (el.style.display = "none"));
      form
        .querySelectorAll(".form-control")
        .forEach((el) => el.classList.remove("is-invalid"));

      // Kiểm tra username
      if (username && username.value.trim() === "") {
        showError(username, "Vui lòng nhập tên tài khoản.");
        isValid = false;
      }

      // Kiểm tra email hợp lệ
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email) {
        if (email.value.trim() === "") {
          showError(email, "Vui lòng nhập email.");
          isValid = false;
        } else if (!emailPattern.test(email.value)) {
          showError(email, "Email không hợp lệ.");
          isValid = false;
        }
      }

      // Kiểm tra mật khẩu
      if (password) {
        if (password.value.trim() === "") {
          showError(password, "Vui lòng nhập mật khẩu.");
          isValid = false;
        } else if (password.value.length < 6) {
          showError(password, "Mật khẩu phải có ít nhất 6 ký tự.");
          isValid = false;
        }
      }

      // Kiểm tra số điện thoại
      const phonePattern = /^[0-9]{10,11}$/;
      if (phone) {
        if (phone.value.trim() === "") {
          showError(phone, "Vui lòng nhập số điện thoại.");
          isValid = false;
        } else if (!phonePattern.test(phone.value)) {
          showError(
            phone,
            "Số điện thoại không hợp lệ (chỉ chứa 10-11 chữ số)."
          );
          isValid = false;
        }
      }

      // Kiểm tra địa chỉ
      if (address && address.value.trim() === "") {
        showError(address, "Vui lòng nhập địa chỉ.");
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
      let avatar = this.getAttribute("data-avatar");
      let username = this.getAttribute("data-username");
      let name = this.getAttribute("data-name");
      let email = this.getAttribute("data-email");
      let phone = this.getAttribute("data-phone");
      let address = this.getAttribute("data-address");
      let status = this.getAttribute("data-status");

      // Gán dữ liệu vào form
      document.getElementById("id-field-edit").value = id;
      document.getElementById("username-field-edit").value = username;
      document.getElementById("name-field-edit").value = name;
      document.getElementById("mail-field-edit").value = email;
      document.getElementById("phone-field-edit").value = phone;
      document.getElementById("address-field-edit").value = address;
      document.getElementById("status-field-edit").value = status || "0";

      document.getElementById("product-img-edit").src = avatar;

      // Cập nhật action của form để gửi đúng ID
      document
        .querySelector(".tablelist-form.edit")
        .setAttribute("action", `users/${id}`);
    });
  });
});
