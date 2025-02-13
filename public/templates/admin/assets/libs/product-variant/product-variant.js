document.addEventListener("DOMContentLoaded", function () {
  let variantsTable = document.getElementById("variantsContainer");
  let sizes = JSON.parse(variantsTable.dataset.sizes);
  let colors = JSON.parse(variantsTable.dataset.colors);
  let variantIndex = parseInt(document.getElementById("lastIndex").value) + 1;

  document
    .getElementById("addMoreVariant")
    .addEventListener("click", function () {
      let sizeOptions = `<option value="">Chọn kích cỡ</option>`;
      for (let size_id in sizes) {
        sizeOptions += `<option value="${size_id}">${sizes[size_id]}</option>`;
      }

      let colorOptions = `<option value="">Chọn màu</option>`;
      for (let color_id in colors) {
        colorOptions += `<option value="${color_id}">${colors[color_id]}</option>`;
      }

      let newVariant = `
      <tr class="variant">
      <input type="hidden" value="" name="product_variant[${variantIndex}][id]">
                <td class="align-middle">
                    <div class="position-relative d-inline-block">
                        <div class="position-absolute top-100 start-100 translate-middle">
                            <label for="imagePreviewVariantInput_${variantIndex}" class="mb-0" data-bs-toggle="tooltip"
                                data-bs-placement="right" aria-label="Select Image" data-bs-original-title="Select Image">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                        <i class="mdi mdi-image text-muted fs-16 p-1"></i>
                                    </div>
                                </div>
                            </label>
                            <input class="form-control d-none" id="imagePreviewVariantInput_${variantIndex}" type="file"
                                accept="image/png, image/gif, image/jpeg" onchange="previewImageVariant(event, ${variantIndex})"
                                name="product_variant[${variantIndex}][image]">
                        </div>
                        <div class="avatar-sm">
                            <div class="avatar-title bg-light rounded">
                                <img src="" id="imagePreviewVariant_${variantIndex}" class="avatar-sm h-auto" alt="">
                            </div>
                        </div>
                    </div>
                </td>
                <td class="align-middle">
                    <select class="form-control" name="product_variant[${variantIndex}][size]">
                        ${sizeOptions}
                    </select>
                </td>
                <td class="align-middle">
                    <select class="form-control" name="product_variant[${variantIndex}][color]">
                        ${colorOptions}
                    </select>
                </td>
                <td class="align-middle">
                    <input class="form-control" type="text" name="product_variant[${variantIndex}][quantity]"
                        placeholder="Số lượng">
                </td>
                <td class="align-middle">
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="product-price-addon">VNĐ</span>
                        <input type="text" class="form-control" id="product-price-input" placeholder="Giá"
                            aria-label="Price" aria-describedby="product-price-addon"
                            name="product_variant[${variantIndex}][price]" oninput="formatCurrency(this)">
                    </div>
                </td>
                <td class="align-middle">
                    <div class="btn btn-danger removeVariant">X</div>
                </td>
            </tr>`;

      document
        .getElementById("variantsContainer")
        .insertAdjacentHTML("beforeend", newVariant);
      variantIndex++;
    });

  document
    .getElementById("variantsContainer")
    .addEventListener("click", function (event) {
      if (event.target.classList.contains("removeVariant")) {
        if (confirm("Bạn có chắc chắn muốn xóa biến thể này?")) {
          event.target.closest("tr").remove();
        }
      }
    });
});

document.addEventListener("DOMContentLoaded", function () {
  let deletedVariants = []; // Lưu danh sách ID biến thể bị xóa
  let removedRows = {}; // Lưu `<tr>` đã bị xóa

  document.querySelectorAll(".removeVariant").forEach((button) => {
    button.addEventListener("click", function () {
      let row = this.closest(".variant");
      let variantId = row.dataset.id; // Lấy ID của biến thể

      if (variantId) {
        deletedVariants.push(variantId);
        document.getElementById("deletedVariants").value =
          JSON.stringify(deletedVariants);
      }

      removedRows[variantId] = row; // Lưu `<tr>` bị xóa
      row.remove(); // Xóa khỏi DOM

      // Thêm vào danh sách hoàn tác
      let undoList = document.getElementById("undoList");
      let undoItem = document.createElement("li");
      undoItem.innerHTML = `
                <span>Có biến thể cũ vừa bị xóa</span> 
                <a href="javascript:void(0)" class="text-warning undoDelete" data-id="${variantId}">Hoàn tác</a>
            `;
      undoList.appendChild(undoItem);
    });
  });

  // Xử lý khi nhấn "Hoàn tác"
  document
    .getElementById("undoList")
    .addEventListener("click", function (event) {
      if (event.target.classList.contains("undoDelete")) {
        let variantId = event.target.dataset.id;

        if (removedRows[variantId]) {
          let table = document.querySelector("table tbody"); // Chọn vị trí bảng
          table.appendChild(removedRows[variantId]); // Thêm lại hàng bị xóa

          // Xóa khỏi danh sách bị xóa
          deletedVariants = deletedVariants.filter((id) => id !== variantId);
          document.getElementById("deletedVariants").value =
            JSON.stringify(deletedVariants);

          // Xóa khỏi danh sách hoàn tác
          event.target.closest("li").remove();
        }
      }
    });
});



