function formatCurrency(input) {
  let value = input.value.replace(/\D/g, ""); // Chỉ giữ số
  let number = parseInt(value, 10);

  if (isNaN(number)) {
    input.value = "";
    return;
  }

  input.value = number.toLocaleString("vi-VN");
}

function removeCurrencyFormat() {
  let priceInputs = document.querySelectorAll("#product-price-input"); // Lấy tất cả phần tử có ID
  priceInputs.forEach((input) => {
    input.value = input.value.replace(/\./g, ""); // Xóa dấu chấm trong từng ô input
  });
}