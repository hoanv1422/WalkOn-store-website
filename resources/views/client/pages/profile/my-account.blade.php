<div class="account-area py-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="text-center p-4 bg-light">
                            <div class="sidebar-avatar-container">
                                <img id="sidebar-avatar"
                                    src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                    alt="Avatar" class="rounded-circle img-fluid">
                            </div>
                            <h5 id="sidebar-name" class="fw-bold mb-1 mt-3">{{ $user->name }}</h5>
                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" id="profile-link"
                                class="active list-group-item list-group-item-action active d-flex align-items-center">
                                <i class="fa fa-user me-3"></i> Thông tin cá nhân
                            </a>
                            <a href="#" id="address-link"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa fa-map-marker me-3"></i> Địa Chỉ
                            </a>
                            <a href="#" id="change-password-link"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa fa-lock me-3"></i> Đổi Mật Khẩu
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Profile Section -->
                <div id="profile-section" class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-1">Hồ Sơ Của Tôi</h4>
                        <p class="text-muted mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        <hr class="my-4">

                        <form id="profile-update-form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Thông tin người dùng -->
                                    <div class="mb-4 row align-items-center">
                                        <label for="username"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Tên đăng
                                            nhập</label>
                                        <div class="col-sm-8">
                                            <div class="readonly-field-container">
                                                <input type="text" class="form-control-plaintext fw-medium"
                                                    id="username" value="{{ $user->username }}" readonly>
                                                <div class="readonly-badge">
                                                    <i class="fa fa-lock me-1"></i>Không thể sửa
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="name"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Tên</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control bg-white" id="name"
                                                name="name" value="{{ $user->name }}">
                                            <div class="error-message text-danger mt-1" id="name-error"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="email"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Email</label>
                                        <div class="col-sm-8">
                                            <div class="readonly-field-container">
                                                <input type="email" class="form-control-plaintext fw-medium"
                                                    id="email" value="{{ $user->email }}" readonly>
                                                <div class="readonly-badge">
                                                    <i class="fa fa-lock me-1"></i>Không thể sửa
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="phone"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Số điện
                                            thoại</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control bg-white" id="phone"
                                                name="phone" value="{{ $user->phone }}">
                                            <div class="error-message text-danger mt-1" id="phone-error"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 offset-sm-4">
                                            <button type="submit" class="btn btn-primary px-4 py-2">Lưu</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="avatar-upload mb-3">
                                        <div class="avatar-container mb-3">
                                            <img id="avatar-preview"
                                                src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                                alt="Avatar">
                                        </div>

                                        <div class="d-grid">
                                            <label for="avatar" class="btn btn-outline-secondary">
                                                <i class="fa fa-camera me-2"></i>Chọn Ảnh
                                            </label>
                                            <input type="file" class="d-none" id="avatar" name="avatar"
                                                accept="image/*">
                                            <div class="error-message text-danger mt-1" id="avatar-error"></div>
                                        </div>
                                        <p class="small text-muted mt-2">
                                            Dung lượng file tối đa 1 MB<br>
                                            Định dạng: JPEG, PNG
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Address Section -->
                <div id="address-section" class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="fw-bold mb-1">Địa Chỉ Của Tôi</h4>
                                <p class="text-muted mb-0">Quản lý địa chỉ giao hàng</p>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#AddressModal">
                                <i class="fa fa-plus me-2"></i>Thêm địa chỉ mới
                            </button>
                        </div>
                        <hr class="my-4">
                        <!-- Address List -->
                        <div class="address-list"></div>
                    </div>
                </div>


                <div id="change-password-section" class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="fw-bold mb-1">Đổi mật khẩu</h4>
                                <p class="text-muted mb-0">Cập nhật mật khẩu của bạn để bảo mật tài khoản</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <!-- Password Change Form -->
                        <form id="change-password-form">
                            <div class="mb-3">
                                <label for="current-password" class="form-label">Mật khẩu hiện tại</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current-password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="current-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <!-- Error message will be appended here -->
                            </div>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">Mật khẩu mới</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new-password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="new-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">
                                    Mật khẩu phải có ít nhất 8 ký tự, tối đa 20 ký tự, bao gồm chữ hoa, số và ký tự đặc
                                    biệt.
                                </small>
                                <!-- Error message will be appended here -->
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Xác nhận mật khẩu mới</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm-password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="confirm-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <!-- Error message will be appended here -->
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2">Hủy</button>
                                <button type="submit" class="btn btn-primary">Xác nhận thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal thêm địa chỉ mới -->
<div class="modal fade" id="AddressModal" tabindex="-1" aria-labelledby="AddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="" id="address-form">
            @csrf
            <div class="modal-content">
                <div class="d-flex justify-content-between m-3">
                    <h5 class="modal-title" id="AddressModalLabel">Thêm Địa Chỉ Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="address-error" class="alert alert-danger d-none" role="alert"></div>
                    <input type="hidden" id="address-id" name="address_id">
                    <div class="d-flex gap-2">
                        <select id="province" class="form-control" name="city_code"
                            onchange="loadDistricts(); updateHiddenInputs();">
                            <option value="">-- Chọn Tỉnh/Thành --</option>
                        </select>
                        <select id="district" class="form-control" onchange="loadWards(); updateHiddenInputs();"
                            name="district_code" disabled>
                            <option value="">-- Chọn Quận/Huyện --</option>
                        </select>
                        <select id="ward" class="form-control"
                            onchange="getCoordinates(); updateHiddenInputs();" name="ward_code" disabled>
                            <option value="">-- Chọn Phường/Xã --</option>
                        </select>
                    </div>
                    <input type="hidden" id="provinceName" name="province_name">
                    <input type="hidden" id="districtName" name="district_name">
                    <input type="hidden" id="wardName" name="ward_name">
                    <div class="mb-3 mt-3">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="newAddressDetail" name="address_line" rows="2"
                            placeholder="Địa chỉ cụ thể"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress1"
                            value="HOME" autocomplete="off">
                        <label class="btn btn-outline-primary" for="typeOfAddress1">Nhà Riêng</label>
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress2"
                            value="OFFICE" autocomplete="off">
                        <label class="btn btn-outline-success" for="typeOfAddress2">Cơ Quan</label>
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress3"
                            value="OTHER" autocomplete="off">
                        <label class="btn btn-outline-warning" for="typeOfAddress3">Khác</label>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" id="check-default" name="default_address" class="form-check-input">
                        <label class="form-check-label" for="check-default">
                            Đặt làm mặc định
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Lưu địa chỉ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal xác nhận đặt địa chỉ mặc định -->
<div class="modal fade" id="setDefaultModal" tabindex="-1" aria-labelledby="setDefaultModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="setDefaultForm">
            @csrf
            <div class="modal-content">
                <div class="d-flex justify-content-between m-3">
                    <h5 class="modal-title" id="setDefaultModalLabel">Xác nhận đặt địa chỉ mặc định</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn đặt địa chỉ này làm địa chỉ mặc định?</p>
                    <input type="hidden" id="set-default-address-id" name="address_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal xác nhận xóa địa chỉ -->
<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form>
            @csrf
            <div class="modal-content">
                <div class="d-flex justify-content-between m-3">
                    <h5 class="modal-title" id="deleteAddressModalLabel">Xác nhận xóa địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Bạn có chắc muốn xóa địa chỉ này?</p>
                    <p class="small text-muted">Hành động này không thể hoàn tác.</p>
                    <input type="hidden" id="delete-address-id" name="address_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </div>
        </form>
    </div>
</div>





<!-- JavaScript để xử lý xem trước ảnh -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const sidebarName = document.getElementById('sidebar-name');
        const nameInput = document.getElementById('name');

        // Xử lý xem trước ảnh khi chọn file
        if (avatarInput) {
            avatarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result;
                        sidebarAvatar.src = e.target.result;
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Cập nhật tên trong sidebar khi thay đổi
        if (nameInput && sidebarName) {
            nameInput.addEventListener('input', function() {
                sidebarName.textContent = this.value;
            });
        }
    });
</script>
<script>
    // GraphHopper API key for geocoding
    const GRAPH_HOPPER_API_KEY = "8c5e66d0-53b9-4218-af36-3223f27769ec";

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', () => {
        initNavigation();
        initAvatarPreview();
        initAddressForm();
        initModalListeners();
        togglePassword();
    });

    function togglePassword() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        // Thêm sự kiện click cho mỗi nút
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Lấy ID của input mật khẩu từ data-target
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                // Chuyển đổi giữa hiển thị và ẩn mật khẩu
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    this.innerHTML = '<i class="fa fa-eye"></i>';
                }
            });
        });
    }

    function clearAllErrors() {
        const errorElements = document.querySelectorAll('.invalid-feedback');
        errorElements.forEach(element => element.remove());

        const invalidInputs = document.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
    }

    // Hàm hiển thị lỗi cho một trường cụ thể
    function showError(fieldId, errorMessage) {
        const field = document.getElementById(fieldId);
        if (!field) return;

        // Thêm class is-invalid cho input
        field.classList.add('is-invalid');

        // Tạo phần tử thông báo lỗi
        const errorDiv = document.createElement('span');
        errorDiv.className = 'invalid-feedback d-block';
        errorDiv.textContent = errorMessage;

        // Thêm thông báo lỗi vào sau input (hoặc input-group nếu có)
        const parentElement = field.closest('.input-group') || field;
        parentElement.parentNode.appendChild(errorDiv);
    }

    // Xử lý form submit
    const form = document.getElementById('change-password-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Xóa tất cả lỗi cũ trước khi validate
            clearAllErrors();

            // Lấy giá trị từ các input
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            // Gửi request API đổi mật khẩu
            fetch('/api/change-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        current_password: currentPassword,
                        password: newPassword,
                        password_confirmation: confirmPassword
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Hiển thị thông báo thành công
                        showMessage('Đổi mật khẩu thành công!', '#4CAF50');

                        // Reset form
                        form.reset();
                    } else {
                        // Hiển thị lỗi tương ứng cho từng trường
                        if (data.errors) {
                            if (data.errors.current_password) {
                                showError('current-password', data.errors.current_password[0]);
                            }
                            if (data.errors.password) {
                                showError('new-password', data.errors.password[0]);
                            }
                            if (data.errors.password_confirmation) {
                                showError('confirm-password', data.errors.password_confirmation[0]);
                            }
                        } else if (data.message) {
                            showMessage(data.message, '#F44336');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Đã xảy ra lỗi khi đổi mật khẩu', '#F44336');
                });
        });
    }

    // Navigation between profile and address sections
    function initNavigation() {
        const profileLink = document.getElementById('profile-link');
        const addressLink = document.getElementById('address-link');
        const changePasswordLink = document.getElementById('change-password-link');

        const profileSection = document.getElementById('profile-section');
        const addressSection = document.getElementById('address-section');
        const changePasswordSection = document.getElementById('change-password-section');

        if (
            profileLink && addressLink && changePasswordLink &&
            profileSection && addressSection && changePasswordSection
        ) {
            profileLink.addEventListener('click', (e) => {
                e.preventDefault();
                profileSection.style.display = 'block';
                addressSection.style.display = 'none';
                changePasswordSection.style.display = 'none';

                profileLink.classList.add('active');
                addressLink.classList.remove('active');
                changePasswordLink.classList.remove('active');
            });

            addressLink.addEventListener('click', (e) => {
                e.preventDefault();
                profileSection.style.display = 'none';
                addressSection.style.display = 'block';
                changePasswordSection.style.display = 'none';

                profileLink.classList.remove('active');
                addressLink.classList.add('active');
                changePasswordLink.classList.remove('active');

                if (!window.addressesLoaded) {
                    fetchAddresses();
                    window.addressesLoaded = true;
                }
            });

            changePasswordLink.addEventListener('click', (e) => {
                e.preventDefault();
                profileSection.style.display = 'none';
                addressSection.style.display = 'none';
                changePasswordSection.style.display = 'block';

                profileLink.classList.remove('active');
                addressLink.classList.remove('active');
                changePasswordLink.classList.add('active');
            });

            // Hiển thị mặc định tab hồ sơ
            profileLink.click();
        }
    }


    // Avatar upload and preview
    function initAvatarPreview() {
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const sidebarAvatar = document.getElementById('sidebar-avatar');

        if (avatarInput && avatarPreview) {
            avatarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        avatarPreview.src = e.target.result;
                        if (sidebarAvatar) {
                            sidebarAvatar.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    }

    // Initialize address form and location selectors
    function initAddressForm() {
        loadProvinces();

        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        if (provinceSelect && districtSelect && wardSelect) {
            provinceSelect.addEventListener('change', () => {
                loadDistricts();
                updateHiddenInputs();
                getCoordinates();
            });

            districtSelect.addEventListener('change', () => {
                loadWards();
                updateHiddenInputs();
                getCoordinates();
            });

            wardSelect.addEventListener('change', () => {
                updateHiddenInputs();
                getCoordinates();
            });
        }

        // Setup form submission handlers
        const addAddressForm = document.getElementById('address-form');
        if (addAddressForm) {
            addAddressForm.addEventListener('submit', handleAddAddress);
        }

        const setDefaultForm = document.getElementById('setDefaultForm');
        if (setDefaultForm) {
            setDefaultForm.addEventListener('submit', handleSetDefaultAddress);
        }

        const deleteForm = document.querySelector('#deleteAddressModal form');
        if (deleteForm) {
            deleteForm.addEventListener('submit', handleDeleteAddress);
        }
    }

    // Modal event listeners
    function initModalListeners() {
        const AddressModal = document.getElementById('AddressModal');
        if (AddressModal) {
            AddressModal.addEventListener('hidden.bs.modal', resetAddressForm);
        }
    }

    // Reset the address form when modal is closed
    function resetAddressForm() {
        // Reset form ID and title
        document.getElementById('address-id').value = '';
        document.getElementById('AddressModalLabel').textContent = 'Thêm Địa Chỉ Mới';

        // Reset location selectors
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');


        if (provinceSelect && districtSelect && wardSelect) {
            provinceSelect.innerHTML = '<option value="">-- Chọn Tỉnh/Thành phố --</option>';
            districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
            wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            districtSelect.disabled = true;
            wardSelect.disabled = true;
            loadProvinces();
        }

        // Reset address detail input
        document.getElementById('newAddressDetail').value = '';
        document.getElementById('provinceName').value = '';
        document.getElementById('districtName').value = '';
        document.getElementById('wardName').value = '';
        document.getElementById('longitude').value = '';
        document.getElementById('latitude').value = '';
        const errorDiv = document.getElementById('address-error');
        if (errorDiv) {
            errorDiv.innerHTML = '';
            errorDiv.classList.add('d-none');
        } else {
            console.warn('address-error element not found');
        }

        // Reset address type radio buttons
        const typeRadios = document.querySelectorAll('input[name="addressType"]');
        typeRadios.forEach(radio => {
            radio.checked = false;
        });

        // Reset default checkbox
        document.getElementById('check-default').checked = false;
    }

    // Load provinces from API
    async function loadProvinces() {
        const provinceSelect = document.getElementById('province');
        if (!provinceSelect) return Promise.resolve();

        try {
            const response = await fetch('https://provinces.open-api.vn/api/p/');
            const provinces = await response.json();
            provinceSelect.innerHTML = '<option value="">-- Chọn Tỉnh/Thành phố --</option>';
            provinces.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.code;
                option.text = prov.name;
                provinceSelect.appendChild(option);
            });
            return Promise.resolve();
        } catch (error) {
            console.error('Lỗi khi tải tỉnh/thành:', error);
            return Promise.reject(error);
        }
    }

    // Load districts based on selected province
    async function loadDistricts() {
        const provinceCode = document.getElementById('province').value;
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
        wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
        districtSelect.disabled = true;
        wardSelect.disabled = true;

        if (provinceCode) {
            try {
                const response = await fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
                const data = await response.json();
                const districts = data.districts;
                districts.forEach(dist => {
                    const option = document.createElement('option');
                    option.value = dist.code;
                    option.text = dist.name;
                    districtSelect.appendChild(option);
                });
                districtSelect.disabled = false;
            } catch (error) {
                console.error('Lỗi khi tải quận/huyện:', error);
            }
        }
    }

    // Load wards based on selected district
    async function loadWards() {
        const districtCode = document.getElementById('district').value;
        const wardSelect = document.getElementById('ward');

        wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
        wardSelect.disabled = true;

        if (districtCode) {
            try {
                const response = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                const data = await response.json();
                const wards = data.wards;
                wards.forEach(ward => {
                    const option = document.createElement('option');
                    option.value = ward.code;
                    option.text = ward.name;
                    wardSelect.appendChild(option);
                });
                wardSelect.disabled = false;
            } catch (error) {
                console.error('Lỗi khi tải phường/xã:', error);
            }
        }
    }

    // Get coordinates from address using GraphHopper API
    async function getCoordinates() {
        const province = document.getElementById('province').options[document.getElementById('province')
            .selectedIndex]?.text || '';
        const district = document.getElementById('district').options[document.getElementById('district')
            .selectedIndex]?.text || '';
        const ward = document.getElementById('ward').options[document.getElementById('ward').selectedIndex]?.text ||
            '';

        if (!province || !district || !ward) return;

        const query = `${ward}, ${district}, ${province}, Vietnam`;

        try {
            const response = await fetch(
                `https://graphhopper.com/api/1/geocode?q=${encodeURIComponent(query)}&key=${GRAPH_HOPPER_API_KEY}`
            );
            const data = await response.json();

            if (data.hits && data.hits.length > 0) {
                const {
                    lat,
                    lng
                } = data.hits[0].point;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            } else {
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
            }
        } catch (error) {
            console.error('Lỗi khi lấy tọa độ:', error);
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        }
    }

    // Update hidden inputs with location names
    function updateHiddenInputs() {
        const province = document.getElementById('province').options[document.getElementById('province').selectedIndex]
            ?.text || '';
        const district = document.getElementById('district').options[document.getElementById('district').selectedIndex]
            ?.text || '';
        const ward = document.getElementById('ward').options[document.getElementById('ward').selectedIndex]?.text || '';

        document.getElementById('provinceName').value = province;
        document.getElementById('districtName').value = district;
        document.getElementById('wardName').value = ward;
    }

    // Fetch user addresses from API
    async function fetchAddresses() {
        try {
            const response = await fetch('/api/addresses', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to fetch addresses');

            const addresses = await response.json();
            renderAddresses(addresses);
        } catch (error) {
            console.error('Error fetching addresses:', error);
            renderAddresses([]);
        }
    }

    // Render addresses to the UI
    function renderAddresses(addresses) {
        const addressList = document.querySelector('.address-list');
        if (!addressList) return;

        addressList.innerHTML = '';

        if (!addresses || addresses.length === 0) {
            addressList.innerHTML = `
            <div class="text-center py-5">
                <i class="fa fa-map-marker fa-3x text-muted mb-3"></i>
                <h5 class="fw-bold">Bạn chưa có địa chỉ nào</h5>
                <p class="text-muted">Thêm địa chỉ để thuận tiện cho việc giao hàng</p>
            </div>
        `;
            return;
        }

        addresses.forEach(address => {

            const addressItem = document.createElement('div');
            addressItem.className = 'address-item card mb-3 border';
            addressItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1"><i class="fa fa-map-marker me-2 text-muted"></i>${address.full_address}</p>
                        <p class="mb-1"><strong>Loại:</strong> ${address.type_label}</p>
                        ${address.is_default ? '<span class="badge bg-primary">Mặc định</span>' : ''}
                    </div>
                    <div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary btn-sm" 
                                    onclick="editAddress(${address.id}, '${address.city_code}', '${address.district_code}', '${address.ward_code}', '${address.address_line}', '${address.latitude}' , '${address.longitude}', '${address.type}', ${address.is_default})">
                                <i class="fa fa-edit"></i> Sửa
                            </button>
                            ${!address.is_default ? `
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#setDefaultModal"
                                        onclick="setModalAddressId('set-default-address-id', ${address.id})">
                                    <i class="fa fa-check"></i> Đặt mặc định
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#deleteAddressModal"
                                        onclick="setModalAddressId('delete-address-id', ${address.id})">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            ` : ''}
                        </div>
                    </div>
                </div>
            </div>
        `;
            addressList.appendChild(addressItem);
        });
    }

    // Set address ID in modal forms
    function setModalAddressId(inputId, addressId) {
        const input = document.getElementById(inputId);
        if (input) input.value = addressId;
    }

    // Handle setting default address
    async function handleSetDefaultAddress(event) {
        event.preventDefault();

        const addressId = document.getElementById('set-default-address-id').value;
        if (!addressId || isNaN(addressId) || addressId <= 0) {
            console.error('Invalid address ID');
            alert('Please select a valid address.');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('An error occurred. Please refresh the page.');
            return;
        }

        try {
            const response = await fetch(`/api/addresses/${addressId}/set-default`, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                    // Thêm 'Authorization': `Bearer ${token}` nếu cần
                },
                body: JSON.stringify({})
            });

            const result = await response.json();
            if (!response.ok) {
                throw new Error(result.message || 'Failed to set default address');
                const error = "Lỗi khi chuyển đổi địa chỉ mặc định."
                showMessage(error, '#dc3545');
            }

            const success = "Chuyển đổi địa chỉ mặc định thành công."
            showMessage(success, '#28a745');
            const setDefaultModal = bootstrap.Modal.getInstance(document.getElementById('setDefaultModal'));
            if (setDefaultModal) {
                setDefaultModal.hide();
            } else {
                console.warn('Modal instance not found');
            }

            if (typeof fetchAddresses === 'function') {
                fetchAddresses();
            } else {
                console.error('fetchAddresses function is not defined');
            }
        } catch (error) {
            console.error('Error setting default address:', error);
            alert(error.message || 'Failed to set default address. Please try again.');
        }
    }

    // Handle address deletion
    async function handleDeleteAddress(event) {
        event.preventDefault();

        const addressId = document.getElementById('delete-address-id').value;
        if (!addressId) return;

        try {
            const response = await fetch(`/api/addresses/${addressId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                        'content')
                }
            });
            const result = await response.json();

            if (!response.ok) {
                throw new Error('Failed to delete address')
                const error = "Lỗi khi xóa địa chỉ."
                showMessage(error, '#dc3545');
            }
            const success = "Xóa địa chỉ thành công!"
            showMessage(success, '#4CAF50');

            // Close modal and refresh addresses
            const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteAddressModal'));
            if (deleteModal) deleteModal.hide();
            fetchAddresses();
        } catch (error) {
            console.error('Error deleting address:', error);
        }
    }

    // Handle adding or updating an address
    async function handleAddAddress(e) {
        e.preventDefault();

        const errorDiv = document.getElementById('address-error');
        errorDiv.classList.add('d-none');
        errorDiv.innerHTML = '';

        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        if (!data.province_name || !data.city_code || !data.district_name || !data.address_line) {
            errorDiv.innerHTML = 'Vui lòng nhập đầy đủ thông tin bắt buộc.';
            errorDiv.classList.remove('d-none');
            return;
        }

        // Get the address ID to determine if this is an add or edit operation
        const addressId = document.getElementById('address-id').value;
        const isEdit = addressId && addressId.trim() !== '';

        const endpoint = isEdit ? `/api/addresses/${addressId}` : '/api/save-address';
        const method = isEdit ? 'PUT' : 'POST';


        try {
            const response = await fetch(endpoint, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();

            if (!response.ok) {
                // Handle validation errors (422) or server errors (500)
                let errorMessage = result.message || 'Có lỗi xảy ra khi lưu địa chỉ';

                if (response.status === 422 && result.errors) {
                    // Validation errors
                    errorMessage = Object.values(result.errors)
                        .flat()
                        .map(msg => msg)
                        .join('<br>');
                } else if (result.error) {
                    // Server error details
                    errorMessage += `: ${result.error}`;
                }

                // Show error in modal
                errorDiv.innerHTML = errorMessage;
                errorDiv.classList.remove('d-none');
                return; // Keep modal open
            }


            const success = "Lưu địa chỉ thành công!"
            showMessage(success, '#4CAF50');

            const modal = bootstrap.Modal.getInstance(document.getElementById('AddressModal'));
            modal.hide();

            // Refresh address list
            fetchAddresses();

        } catch (error) {
            // Network or unexpected errors
            console.error('Error saving address:', error);
            errorDiv.innerHTML = 'Không thể kết nối đến server. Vui lòng thử lại.';
            errorDiv.classList.remove('d-none');
        }
    }

    // Function to prepare modal for editing an address
    function editAddress(addressId, provinceCode, districtCode, wardCode, addressLine, latitude, longitude, addressType,
        isDefault) {
        // Set form mode to edit


        document.getElementById('address-id').value = addressId;

        // Change modal title
        document.getElementById('AddressModalLabel').textContent = 'Sửa Địa Chỉ';

        // Set address details
        document.getElementById('newAddressDetail').value = addressLine;

        // Set address type
        const typeRadios = document.querySelectorAll('input[name="addressType"]');
        typeRadios.forEach(radio => {
            radio.checked = radio.value === addressType;
        });

        // Set default checkbox
        document.getElementById('check-default').checked = isDefault;

        // Load provinces first, then select the correct province
        loadProvinces().then(() => {
            const provinceSelect = document.getElementById('province');
            provinceSelect.value = provinceCode;

            // Load districts for this province, then select the correct district
            loadDistricts().then(() => {
                const districtSelect = document.getElementById('district');
                districtSelect.value = districtCode;

                // Load wards for this district, then select the correct ward
                loadWards().then(() => {
                    const wardSelect = document.getElementById('ward');
                    wardSelect.value = wardCode;
                    updateHiddenInputs();
                });
            });
        });

        getCoordinates();

        // Open the modal
        const addressModal = new bootstrap.Modal(document.getElementById('AddressModal'));
        addressModal.show();
    }
</script>
