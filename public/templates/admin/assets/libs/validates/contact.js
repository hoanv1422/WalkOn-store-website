document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-item-btn").forEach((button) => {
      button.addEventListener("click", function () {
        let id = this.getAttribute("data-id");
        let contactCode = this.getAttribute("data-contact_code");
        console.log(contactCode);

        let name = this.getAttribute("data-name");
        let email = this.getAttribute("data-email");
        let phone = this.getAttribute("data-phone");
        let message = this.getAttribute("data-message");
        let status = this.getAttribute("data-status");

        document.getElementById("id-field-edit").value = id;
        document.getElementById("contact-code-field-edit").value = contactCode || "N/A";
        document.getElementById("name-field-edit").value = name || "";
        document.getElementById("email-field-edit").value = email || "";
        document.getElementById("phone-field-edit").value = phone || "";
        document.getElementById("message-field-edit").value = message || "";
        let statusField = document.getElementById("status-field-edit");
        if (statusField) {
          let optionExists = Array.from(statusField.options).some(
            (option) => option.value === status
          );

          if (optionExists) {
            statusField.value = status;
          } else {
            statusField.value = "UNREAD";
          }
        }
        document.querySelector(".tablelist-form.edit").setAttribute("action", `contacts/${id}`);
      });
    });
  });
