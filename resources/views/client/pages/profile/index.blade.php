@extends('client.layouts.app')

@section('title', 'Thông Tin Cá Nhân')
@section('breadcrumb', 'Thông Tin Cá Nhân')
@section('style')
    <style>
        .account-area {
            background-color: #ffffff;
            min-height: 100vh;
            padding: 30px 0;
        }

        .card {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05) !important;
            border-radius: 8px !important;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            padding: 0.6rem 0.75rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            color: #333;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            border-color: #aaaaaa;
            box-shadow: 0 0 0 0.2rem rgba(170, 170, 170, 0.15);
            background-color: #ffffff;
        }

        .form-control-plaintext {
            color: #333333;
            background-color: transparent;
            border: none;
            padding-left: 0;
            font-weight: 500;
        }

        .readonly-field-container {
            position: relative;
            padding-bottom: 20px;
        }

        .readonly-badge {
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: 12px;
            color: #777;
            background-color: #f5f5f5;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
        }

        .address-field {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-left: 3px solid #666666;
            transition: all 0.2s ease;
        }

        .address-field:focus {
            background-color: #ffffff;
            border-left: 3px solid #333333;
        }

        /* Completely revised avatar styles */
        .avatar-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 160px;
            height: 160px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: #f5f5f5;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 5px solid #fff;
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Sidebar avatar container */
        .sidebar-avatar-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: #f5f5f5;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 3px solid #fff;
        }

        .sidebar-avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Add spacing between avatar containers */
        .avatar-container+.avatar-container,
        .sidebar-avatar-container+.sidebar-avatar-container {
            margin-top: 20px;
        }

        /* Increase spacing between form fields */
        .mb-4.row {
            margin-bottom: 2rem !important;
        }

        .btn-primary {
            background-color: #444444;
            border-color: #444444;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #333333;
            border-color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            border-color: #d1d1d1;
            color: #555555;
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #eeeeee;
            color: #333333;
            border-color: #bbbbbb;
        }

        hr {
            background-color: #e0e0e0;
            opacity: 0.6;
        }

        .text-secondary {
            color: #555555 !important;
        }

        .text-muted {
            color: #777777 !important;
        }

        .list-group-item-action.active {
            background-color: #f8f9fa;
            border-left: 3px solid #444444;
            color: #333;
            font-weight: 500;
        }

        @media (max-width: 767.98px) {
            .col-form-label {
                margin-bottom: 0.5rem;
                padding-bottom: 0;
            }

            .avatar-container {
                width: 130px;
                height: 130px;
            }

            .sidebar-avatar-container {
                width: 80px;
                height: 80px;
            }

            .card-body {
                padding: 1.25rem;
            }
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.profile.my-account')

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

                // Xóa các thông báo lỗi trước đó
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

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

                    const data = await response.json(); // Chuyển response thành JSON

                    // Nếu cập nhật thành công, hiển thị thông báo thành công
                    if (data.success) {
                        const success = "Lưu thành công!";
                        showMessage(success, '#4CAF50');
                    } else {
                        // Xử lý lỗi từ server
                        if (data.errors) {
                            for (const [field, messages] of Object.entries(data.errors)) {
                                const errorElement = document.getElementById(`${field}-error`);
                                if (errorElement) {
                                    // Hiển thị lỗi đầu tiên hoặc nối các lỗi
                                    errorElement.textContent = Array.isArray(messages) ? messages.join(
                                        ', ') : messages;
                                }
                            }
                        } else {
                            // Hiển thị lỗi chung nếu không có lỗi cụ thể
                            showMessage('Đã có lỗi xảy ra!', '#f44336');
                        }
                    }
                } catch (error) {
                    console.error(error);
                    showMessage('Lỗi kết nối đến máy chủ!', '#f44336');
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
        });
    </script>
@endsection
