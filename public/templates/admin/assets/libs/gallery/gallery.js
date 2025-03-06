document
  .getElementById("fileInput")
  .addEventListener("change", function (event) {
    const fileInput = event.target;
    const files = fileInput.files;
    const previewList = document.getElementById("dropzone-preview");

    // Duyệt qua danh sách file và thêm vào danh sách
    Array.from(files).forEach((file) => {
      const listItem = document.createElement("li");
      listItem.className =
        "mt-2 dz-processing dz-image-preview dz-success dz-complete";
      listItem.innerHTML = `
                    <div class="border rounded p-2 d-flex align-items-center">                                                
                        <!-- Hình ảnh thu nhỏ -->
                        <div class="flex-shrink-0 me-3">    
                            <div class="avatar-sm bg-light rounded">
                                <img class="img-fluid rounded d-block h-100" src="${URL.createObjectURL(
                                  file
                                )}" alt="${file.name}"> 
                            </div>
                        </div>                                                            
                        <!-- Thông tin ảnh -->
                        <div class="flex-grow-1">                                                                
                            <div class="pt-1">                                                                    
                                <h5 class="fs-14 mb-1">${
                                  file.name
                                }</h5>                                                                    
                                <p class="fs-13 text-muted mb-0"><strong>${(
                                  file.size /
                                  1024 /
                                  1024
                                ).toFixed(
                                  2
                                )}</strong> MB</p>                                                                    
                            </div>                                                            
                        </div>                                                            
                        <!-- Nút xóa -->
                        <div class="flex-shrink-0 ms-3">                                                                
                            <a class="btn btn-sm btn-danger" onclick="confirmAndRemove(this)">Xóa</a>                                                            
                        </div>                                                        
                    </div>
                `;
      previewList.appendChild(listItem);
    });
  });

// Hàm xác nhận và xóa
function confirmAndRemove(element) {
  if (confirm("Bạn có chắc muốn xóa không?")) {
    element.closest("li").remove();
  }
}


function previewImage(event) {
  const file = event.target.files[0]; // Lấy file được chọn
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const imagePreview = document.getElementById("product-img"); // Thẻ img sẽ hiển thị ảnh
      imagePreview.src = e.target.result; // Đặt ảnh mới vào thẻ img
    };
    reader.readAsDataURL(file); // Đọc file dưới dạng URL để hiển thị ảnh
  }
}

function previewImageEdit(event) {
  const file = event.target.files[0]; // Lấy file được chọn
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const previewImageEdit = document.getElementById("product-img-edit"); // Thẻ img sẽ hiển thị ảnh
      previewImageEdit.src = e.target.result; // Đặt ảnh mới vào thẻ img
    };
    reader.readAsDataURL(file); // Đọc file dưới dạng URL để hiển thị ảnh
  }
}



function previewImageVariant(event, index) {
  const input = event.target;
  const imagePreview = document.getElementById(`imagePreviewVariant_${index}`);
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      imagePreview.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

     let deletedImages = []; // Lưu danh sách ID ảnh bị xóa
     let deletedElements = []; // Lưu danh sách phần tử HTML bị xóa

     function removeExistingImage(el, imageId) {
       if (confirm("Bạn có chắc muốn xóa ảnh này?")) {
         let listItem = el.closest(".preview-item");
         deletedImages.push(imageId);
         deletedElements.push(listItem); // Lưu phần tử bị xóa

         // Cập nhật input ẩn
         document.getElementById("deletedImages").value =
           JSON.stringify(deletedImages);

         // Ẩn phần tử khỏi giao diện
         listItem.style.display = "none";

         // Hiển thị khu vực hoàn tác
         document.getElementById("undo-area").classList.remove("d-none");
       }
     }

     // Hoàn tác xóa ảnh
     function undoRemove() {
       if (deletedImages.length > 0) {
         let lastDeletedId = deletedImages.pop(); // Xóa ID cuối cùng khỏi danh sách xóa
         let lastDeletedElement = deletedElements.pop(); // Khôi phục phần tử cuối cùng

         if (lastDeletedElement) {
           lastDeletedElement.style.display = "block";
         }

         // Cập nhật lại input ẩn
         document.getElementById("deletedImages").value =
           JSON.stringify(deletedImages);

         // Ẩn khu vực hoàn tác nếu không còn ảnh nào để khôi phục
         if (deletedImages.length === 0) {
           document.getElementById("undo-area").classList.add("d-none");
         }
       }
     }
