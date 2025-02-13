$(document).ready(function () {
  function showToast(toastId) {
    let toast = $("#" + toastId);
    toast.addClass("show"); // Trượt vào

    // Tự động ẩn sau 2 giây
    setTimeout(function () {
      toast.removeClass("show"); // Trượt ra ngoài
    }, 2000);
  }

  // Kiểm tra nếu có toast thì hiển thị
  if ($("#success-toast").length) {
    showToast("success-toast");
  }
  if ($("#error-toast").length) {
    showToast("error-toast");
  }

  // Xử lý nút đóng
  $(".close-toast").click(function () {
    $(this).parent().removeClass("show");
  });
});
