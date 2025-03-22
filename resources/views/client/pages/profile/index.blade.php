@extends('client.layouts.app')

@section('title', 'Thông Tin Cá Nhân')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.profile.my-account')

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy các phần tử cần thao tác
            const form = document.querySelector('#profile-update-form');
            const avatarInput = document.querySelector('#avatar');
            const avatarPreview = document.querySelector('#avatar-preview');
            const sidebarAvatar = document.querySelector('#sidebar-avatar');
            const sidebarName = document.querySelector('#sidebar-name');
            const notification = document.querySelector('#notification');

            // Xử lý xem trước ảnh khi chọn file
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];

                // Kiểm tra xem file có phải ảnh hợp lệ không
                if (file && file.type.startsWith('image/')) {
                    avatarPreview.src = URL.createObjectURL(file);
                } else {
                    alert("Vui lòng chọn một tệp hình ảnh hợp lệ!");
                    avatarInput.value = ''; // Reset input nếu không hợp lệ
                }
            });

            // Xử lý gửi form bằng AJAX
            form.addEventListener('submit', async function(e) {
                e.preventDefault(); // Ngăn reload trang

                const formData = new FormData(this); // Lấy dữ liệu form

                try {
                    // Gửi request cập nhật thông tin
                    const response = await fetch("{{ route('profile.update') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Bảo vệ CSRF
                            'Accept': 'application/json',
                        }
                    });

                    // Kiểm tra nếu request thất bại
                    if (!response.ok) throw new Error('Lỗi kết nối đến máy chủ');

                    const data = await response.json(); // Chuyển response thành JSON

                    // Nếu cập nhật thành công, cập nhật UI và hiển thị thông báo
                    if (data.success) {
                        updateUI(data.user);
                        showNotification('success', 'Cập nhật thành công!', data.updatedFields);
                    } else {
                        showNotification('danger', 'Lỗi!', data.error);
                    }
                } catch (error) {
                    console.error(error);
                    showNotification('danger', 'Đã có lỗi xảy ra!', 'Vui lòng thử lại sau.');
                }
            });

            /**
             * Hàm cập nhật giao diện sau khi cập nhật thành công
             * @param {Object} user - Dữ liệu user trả về từ server
             */
            function updateUI(user) {
                document.querySelector('#name').value = user.name;
                document.querySelector('#phone').value = user.phone;
                document.querySelector('#address').value = user.address;
                avatarPreview.src = user.avatar;
                sidebarAvatar.src = user.avatar;
                sidebarName.textContent = user.name;
            }

            /**
             * Hàm hiển thị thông báo
             * @param {string} type - Loại thông báo ('success' hoặc 'danger')
             * @param {string} title - Tiêu đề thông báo
             * @param {string | string[]} message - Nội dung thông báo (có thể là mảng)
             */
            function showNotification(type, title, message) {
                notification.innerHTML = `
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-${type} alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                                <i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                                <strong>${title}</strong> ${Array.isArray(message) ? message.join('<br>') : message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    </script>
@endsection
