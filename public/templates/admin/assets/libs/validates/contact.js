document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-item-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let contactCode = this.getAttribute("data-contact_code");
            let name = this.getAttribute("data-name");
            let email = this.getAttribute("data-email");
            let phone = this.getAttribute("data-phone");
            let message = this.getAttribute("data-message");
            let status = this.getAttribute("data-status");
            let responseMessage = this.getAttribute("data-response_message");
            let respondedBy = this.getAttribute("data-responded_by");

            document.getElementById("id-field-edit").value = id;
            document.getElementById("contact-code-field-edit").value =
                contactCode || "N/A";
            document.getElementById("name-field-edit").value = name || "";
            document.getElementById("email-field-edit").value = email || "";
            document.getElementById("phone-field-edit").value = phone || "";
            document.getElementById("message-field-edit").value = message || "";
            
            const responseMessageField = document.getElementById(
                "response-message-field-edit"
            );
            if (responseMessage && responseMessage.trim() !== "") {
                responseMessageField.value = responseMessage;
                responseMessageField.classList.remove("d-none");
            } else {
                responseMessageField.value = "Chưa có phản hồi";
                responseMessageField.classList.add("d-none");
            }
            if (status === "REPLIED") {
                responseMessageField.classList.remove("d-none");
            } else {
                responseMessageField.classList.add("d-none");
            }
            let statusField = document.getElementById("status-field-edit");
            if (statusField) {
                statusField.value = status || "UNREAD";
            }
            document
                .querySelector(".tablelist-form.edit")
                .setAttribute("action", `contacts/${id}`);
        });
    });
});

$("#replyModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);

    var contactId = button.data("id");
    var contactName = button.data("name");
    var contactEmail = button.data("email");
    var customerMessage = button.data("message");
    var formAction = button.data("action");

    $("#reply-contact-id").val(contactId);
    $("#reply-contact-name").text(contactName);
    $("#reply-contact-email").text(contactEmail);
    $("#reply-customer-message").text(customerMessage);
    $("#reply-message").val("");

    $("#replyForm").attr("action", formAction);
});
