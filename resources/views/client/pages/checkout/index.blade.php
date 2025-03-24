@extends('client.layouts.app')

@section('title', 'Checkout')

@section('style')
    <style>
        .address-item {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-item:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }

        .address-item.selected {
            border-color: #3498db;
            background: #eef5ff;
        }

        #addressModal .modal-body,
        #addAddressModal .modal-body {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
        }

        #addressModal .modal-header-1,
        #addAddressModal .modal-header-1 {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Tùy chỉnh tiêu đề modal */
        #addressModal .modal-title,
        #addAddressModal .modal-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        /* Tùy chỉnh nút đóng */
        #addressModal .btn-close,
        #addAddressModal .btn-close {
            background-color: transparent;
            border: none;
            opacity: 0.7;
            transition: opacity 0.2s ease-in-out;
        }

        #addressModal .btn-close:hover,
        #addAddressModal .btn-close:hover {
            opacity: 1;
        }



        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 50px;
            height: 3px;
            background: #3498db;
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .address-display {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .address-item {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-item:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }

        .address-item.selected {
            border-color: #3498db;
            background: #eef5ff;
        }

        .coupon-area {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .coupon-wrapper {
            display: flex;
            align-items: stretch;
        }

        .coupon-input {
            border-radius: 25px 0 0 25px;
        }

        .coupon-btn {
            border-radius: 0 25px 25px 0;
            background: #2ecc71;
            border: none;
            padding: 12px 25px;
            position: relative;
            overflow: hidden;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .coupon-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
            z-index: -1;
        }

        .coupon-btn:hover {
            background: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        .coupon-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .coupon-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 5px rgba(46, 204, 113, 0.2);
        }

        .checkout-btn {
            background: #3498db;
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background: #2980b9;
        }

        .total-amount {
            color: #e74c3c;
            font-size: 24px;
            font-weight: 700;
        }

        .change-address-btn {
            background: #3498db;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            color: white;
            transition: all 0.3s ease;
        }

        .change-address-btn:hover {
            background: #2980b9;
        }

        .payment-option {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.checkout.checkout')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Định nghĩa các hàm ở phạm vi toàn cục
    let selectedAddressElement = null;
    const defaultLat = 21.0285; // Tọa độ mặc định (Hà Nội)
    const defaultLon = 105.8542;

    function formatVND(amount) {
        return new Intl.NumberFormat('vi-VN', { maximumFractionDigits: 0 }).format(amount) + ' VND';
    }

    function selectAddress(element) {
        document.querySelectorAll('.address-item').forEach(item => {
            item.classList.remove('selected');
        });
        element.classList.add('selected');
        selectedAddressElement = element;
    }

    async function confirmAddress() {
        if (selectedAddressElement) {
            const addressText = selectedAddressElement.getAttribute('data-address');
            const addressName = selectedAddressElement.querySelector('strong').textContent;
            const lat = selectedAddressElement.getAttribute('data-lat');
            const lon = selectedAddressElement.getAttribute('data-lon');
            const shippingFee = document.getElementById('shippingFee');
            const displayShippingFee = document.getElementById('displayShippingFee');

            document.getElementById('current-address').innerHTML =
                `<strong>${addressName}</strong><br><span>${addressText}</span>`;
            document.getElementById('selected-address').value = addressText;
            const latitude = document.getElementById('selected-lat').value = lat || '';
            const longitude = document.getElementById('selected-lon').value = lon || '';

            const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
            modal.hide();

            if (latitude && longitude) {
                await calculateDistance(latitude, longitude);
                updatePrices(); // Cập nhật giá sau khi thay đổi địa chỉ
            } else {
                document.getElementById('distance-display').innerHTML =
                    'Không có thông tin khoảng cách (thiếu tọa độ)';
                shippingFee.value = 0;
                displayShippingFee.innerHTML = formatVND(0);
                updatePrices();
            }
        } else {
            alert('Vui lòng chọn một địa chỉ!');
        }
    }

    function hideAddressModal() {
        const addressModal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
        addressModal.hide();
    }

    function saveNewAddress() {
        const name = document.getElementById('newAddressName').value.trim();
        const detail = document.getElementById('newAddressDetail').value.trim();

        if (!name || !detail) {
            alert('Vui lòng nhập đầy đủ thông tin địa chỉ!');
            return;
        }

        const newAddress = document.createElement('div');
        newAddress.className = 'address-item';
        newAddress.setAttribute('data-address', detail);
        newAddress.innerHTML = `<strong>${name}</strong><br><span>${detail}</span>`;
        newAddress.onclick = function() {
            selectAddress(this);
        };
        document.getElementById('addressList').appendChild(newAddress);

        document.getElementById('newAddressName').value = '';
        document.getElementById('newAddressDetail').value = '';
        const addModal = bootstrap.Modal.getInstance(document.getElementById('addAddressModal'));
        addModal.hide();

        setTimeout(() => {
            const addressModal = new bootstrap.Modal(document.getElementById('addressModal'));
            addressModal.show();
            selectAddress(newAddress);
        }, 300);
    }

    async function calculateDistance(lat2, lon2) {
        const apiKey = '8c5e66d0-53b9-4218-af36-3223f27769ec';
        const url =
            `https://graphhopper.com/api/1/route?point=${defaultLat},${defaultLon}&point=${lat2},${lon2}&vehicle=car&locale=vi&key=${apiKey}`;
        const distanceDisplay = document.getElementById('distance-display');
        const shippingFee = document.getElementById('shippingFee');
        const displayShippingFee = document.getElementById('displayShippingFee');
        const shippingFeeForCoupon = document.getElementById('shippingFeeForCoupon');

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.paths && data.paths.length > 0) {
                const distance = parseFloat((data.paths[0].distance / 1000).toFixed(2));
                distanceDisplay.innerHTML = `Khoảng cách từ Hà Nội: ${distance} km`;
                shippingFee.value = calculateShippingFee(distance);
                shippingFeeForCoupon.value = calculateShippingFee(distance);
                displayShippingFee.innerHTML = formatVND(shippingFee.value);
            } else {
                distanceDisplay.innerHTML = 'Không thể tính khoảng cách!';
                shippingFee.value = 0;
                displayShippingFee.innerHTML = formatVND(0);
            }
        } catch (error) {
            distanceDisplay.innerHTML = 'Lỗi khi tính khoảng cách!';
            shippingFee.value = 0;
            displayShippingFee.innerHTML = formatVND(0);
            console.error(error);
        }
    }

    function calculateShippingFee(distance) {
        if (distance <= 10) return distance * 3000;
        else if (distance <= 50) return (10 * 3000) + ((distance - 10) * 5000);
        else return (10 * 3000) + (40 * 5000) + ((distance - 50) * 7000);
    }

    function updatePrices() {
        let originalTotalPrice = parseInt($('#totalPrice').val()) || 0;
        let shippingFee = parseInt($('#shippingFee').val()) || 0;
        let discount = parseInt($('#discountAmount').val()) || 0;
        let finalPrice = originalTotalPrice + shippingFee - discount;

        $('#displayTotalPrice').text(formatVND(originalTotalPrice));
        $('#displayShippingFee').text(formatVND(shippingFee));
        $('#displayDiscount').text('-' + formatVND(discount));
        $('#displayFinalPrice').text(formatVND(finalPrice));
        $('#finalPrice').val(finalPrice);
        $('#totalPriceForCoupon').val(originalTotalPrice);
    }

    // Khởi tạo trong $(document).ready()
    $(document).ready(function() {
        let originalTotalPrice = parseInt($('#totalPrice').val()) || 0;
        let originalShippingFee = parseInt($('#shippingFee').val()) || 0;

        $('#displayTotalPrice').text(formatVND(originalTotalPrice));
        $('#displayShippingFee').text(formatVND(originalShippingFee));
        $('#displayFinalPrice').text(formatVND(originalTotalPrice + originalShippingFee));
        $('#finalPrice').val(originalTotalPrice + originalShippingFee);
        $('#totalPriceForCoupon').val(originalTotalPrice);

        // Tính khoảng cách ban đầu
        const initialLat = document.getElementById('selected-lat').value;
        const initialLon = document.getElementById('selected-lon').value;
        if (initialLat && initialLon) {
            calculateDistance(initialLat, initialLon).then(() => updatePrices());
        } else {
            document.getElementById('distance-display').innerHTML =
                'Không có thông tin khoảng cách (thiếu tọa độ)';
        }

        // Sự kiện submit mã giảm giá
        $('#couponForm').on('submit', function(event) {
            event.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#couponMessage').html('<p class="text-success">' + response.message + '</p>');

                    let discount = response.discount || 0;
                    let shippingDiscount = response.shipping_discount || 0;
                    let finalPrice = response.finalPrice || 0;

                    $('#displayDiscount').text('-' + formatVND(discount + shippingDiscount));
                    $('#discountAmount').val(discount + shippingDiscount);
                    let newShippingFee = parseInt($('#shippingFee').val()) - shippingDiscount;
                    $('#displayShippingFee').text(formatVND(newShippingFee));
                    $('#shippingFee').val(newShippingFee);
                    $('#displayFinalPrice').text(formatVND(finalPrice));
                    $('#finalPrice').val(finalPrice);

                    let couponCode = $('#couponCodeInput').val();
                    $('#couponCodeForOrder').val(couponCode);
                    $('#couponCodeInput').prop('disabled', true);
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi!';
                    $('#couponMessage').html('<p class="text-danger">' + errorMessage + '</p>');
                    $('#couponCodeInput').prop('disabled', false);
                }
            });
        });

        // Sự kiện xóa mã giảm giá
        $('#clearCoupon').on('click', function(event) {
            event.preventDefault();
            $('#couponCodeInput').val('');
            $('#couponMessage').html('');
            $('#couponCodeForOrder').val('');
            $('#displayDiscount').text('-0 VND');
            $('#discountAmount').val(0);
            updatePrices();
            $('#couponCodeInput').prop('disabled', false);
        });

        // Sự kiện modal
        document.getElementById('addAddressModal').addEventListener('hidden.bs.modal', () => {
            document.getElementById('newAddressName').value = '';
            document.getElementById('newAddressDetail').value = '';
        });

        document.getElementById('addressModal').addEventListener('show.bs.modal', () => {
            const firstAddress = document.querySelector('.address-item');
            if (firstAddress && !selectedAddressElement) {
                selectAddress(firstAddress);
            }
        });
    });
</script>

<script>
    const GRAPH_HOPPER_API_KEY = "8c5e66d0-53b9-4218-af36-3223f27769ec"; // Thay bằng API key của bạn

    // Load danh sách tỉnh/thành từ provinces.open-api.vn
    async function loadProvinces() {
        const provinceSelect = document.getElementById("province");
        try {
            const response = await fetch("https://provinces.open-api.vn/api/p/");
            const provinces = await response.json();
            provinces.forEach(prov => {
                const option = document.createElement("option");
                option.value = prov.code; // Truyền code vào value
                option.text = prov.name; // Hiển thị tên
                provinceSelect.appendChild(option);
            });
        } catch (error) {
            console.error("Lỗi khi tải tỉnh/thành:", error);
        }
    }

    // Load quận/huyện
    async function loadDistricts() {
        const provinceCode = document.getElementById("province").value;
        const districtSelect = document.getElementById("district");
        const wardSelect = document.getElementById("ward");

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
                    const option = document.createElement("option");
                    option.value = dist.code; // Truyền code vào value
                    option.text = dist.name; // Hiển thị tên
                    districtSelect.appendChild(option);
                });
                districtSelect.disabled = false;
            } catch (error) {
                console.error("Lỗi khi tải quận/huyện:", error);
            }
        }
    }

    // Load phường/xã
    async function loadWards() {
        const districtCode = document.getElementById("district").value;
        const wardSelect = document.getElementById("ward");

        wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
        wardSelect.disabled = true;

        if (districtCode) {
            try {
                const response = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                const data = await response.json();
                const wards = data.wards;
                wards.forEach(ward => {
                    const option = document.createElement("option");
                    option.value = ward.code; // Truyền code vào value
                    option.text = ward.name; // Hiển thị tên
                    wardSelect.appendChild(option);
                });
                wardSelect.disabled = false;
            } catch (error) {
                console.error("Lỗi khi tải phường/xã:", error);
            }
        }
    }

    // Lấy tọa độ từ GraphHopper Geocoding API
    async function getCoordinates() {
        const province = document.getElementById("province").options[document.getElementById("province")
            .selectedIndex].text;
        const district = document.getElementById("district").options[document.getElementById("district")
            .selectedIndex].text;
        const ward = document.getElementById("ward").options[document.getElementById("ward").selectedIndex].text;
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
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
            } else {
                document.getElementById("latitude").value = "Không tìm thấy";
                document.getElementById("longitude").value = "Không tìm thấy";
            }
        } catch (error) {
            console.error("Lỗi khi lấy tọa độ:", error);
            document.getElementById("latitude").value = "Lỗi";
            document.getElementById("longitude").value = "Lỗi";
        }
    }

    // Cập nhật giá trị cho các input ẩn
    function updateHiddenInputs() {
        const province = document.getElementById("province").options[document.getElementById("province").selectedIndex]
            ?.text || "";
        const district = document.getElementById("district").options[document.getElementById("district").selectedIndex]
            ?.text || "";
        const ward = document.getElementById("ward").options[document.getElementById("ward").selectedIndex]?.text || "";

        document.getElementById("provinceName").value = province;
        document.getElementById("districtName").value = district;
        document.getElementById("wardName").value = ward;
    }

    // Hàm lưu địa chỉ
    async function saveNewAddress() {
        const provinceName = document.getElementById("provinceName").value;
        const districtName = document.getElementById("districtName").value;
        const wardName = document.getElementById("wardName").value;
        const addressDetail = document.getElementById("newAddressDetail").value;
        const latitude = document.getElementById("latitude").value;
        const longitude = document.getElementById("longitude").value;
        const addressType = document.querySelector('input[name="addressType"]:checked')?.value || "Chưa chọn";

        const addressData = {
            province_name: provinceName,
            district_name: districtName,
            ward_name: wardName,
            address_detail: addressDetail,
            latitude: latitude,
            longitude: longitude,
            address_type: addressType
        };

        console.log("Dữ liệu sẽ lưu vào database:", addressData);

        // Gửi dữ liệu lên server (ví dụ)
        try {
            const response = await fetch('/api/save-address', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(addressData),
            });

            if (response.ok) {
                alert("Địa chỉ đã được lưu thành công!");
                const modal = bootstrap.Modal.getInstance(document.getElementById("addAddressModal"));
                modal.hide();
            } else {
                alert("Lỗi khi lưu địa chỉ: " + response.statusText);
            }
        } catch (error) {
            console.error("Lỗi khi gửi dữ liệu:", error);
            alert("Có lỗi xảy ra khi lưu địa chỉ!");
        }
    }

    // Khởi tạo
    window.onload = loadProvinces;

    document.getElementById('addAddressModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('formAddress').reset();
    });
</script>
@endsection
