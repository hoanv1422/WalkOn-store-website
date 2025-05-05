{{-- resources/views/admin/couriers/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Quản lý Shipper')
@section('content')
    <div class="page-content container-fluid"><!-- mở đủ div -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Quản lý Shipper</h5>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModal">Thêm Shipper</button>
            </div>
            <div class="card-body">
                {{-- Filter --}}
                <form method="GET" action="{{ route('couriers.filter') }}" class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                            placeholder="Tên, điện thoại, biển số...">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="date_range" id="datepicker-range" value="{{ request('date_range') }}"
                            class="form-control" placeholder="Chọn khoảng ngày">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="all">Tất cả</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động
                            </option>
                            <option value="suspended"{{ request('status') == 'suspended' ? 'selected' : '' }}>Tạm dừng
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary w-100">Lọc</button>
                    </div>
                </form>

                {{-- Data table --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="courierTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Tên</th>
                                <th>Điện thoại</th>
                                <th>Email</th>
                                <th>Xe</th>
                                <th>Biển số</th>
                                <th>Khu vực</th>
                                <th>Trạng thái</th>
                                <th>Đánh giá</th>
                                <th>Đơn đã giao</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couriers as $c)
                                <tr>
                                    <td><input type="checkbox" name="chk_child"></td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->phone }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->vehicle_type }}</td>
                                    <td>{{ $c->license_plate }}</td>
                                    <td>{{ $c->delivery_area }}</td>
                                    <td>{{ ucfirst($c->status) }}</td>
                                    <td>{{ $c->rating ?? '-' }}</td>
                                    <td>{{ $c->total_orders }}</td>
                                    <td>{{ $c->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning update-btn" data-id="{{ $c->id }}">Cập
                                            nhật</button>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $c->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- đóng .card -->

        <!-- Single Modal cho cả Create & Update -->
        <div class="modal fade" id="formModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="courierForm" method="POST" action="">
                        @csrf
                        <input type="hidden" name="_method" value="POST">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Thêm Shipper</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @include('admin.couriers._form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success" id="formSubmitBtn">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- đóng #formModal -->

    </div><!-- đóng .page-content -->
@endsection

@section('script')
    <script>
        $(function() {
            // DataTable + checkAll
            $('#courierTable').DataTable({
                paging: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
            $('#checkAll').change(function() {
                $('input[name="chk_child"]').prop('checked', this.checked);
            });

            // Mở modal Create
            $('[data-bs-target="#formModal"]').click(function() {
                let form = $('#courierForm');
                form.trigger('reset')
                    .attr('action', '{{ route('couriers.store') }}')
                    .find('input[name="_method"]').val('POST');
                $('#modalTitle').text('Thêm Shipper');
                $('#formSubmitBtn')
                    .removeClass('btn-primary').addClass('btn-success')
                    .text('Lưu');
            });

            // Mở modal Update
            $('.update-btn').click(function() {
                let id = $(this).data('id'),
                    form = $('#courierForm');
                $.get(`/admin/couriers/${id}`, function(data) {
                    // Replace user select with hidden input
                    form.find('[name=user_id]').replaceWith(
                        `<input type="hidden" name="user_id" value="${data.user_id}">`
                    );
                    // Điền giá trị vào các field
                    form.find('[name=name]').val(data.name);
                    form.find('[name=phone]').val(data.phone);
                    form.find('[name=email]').val(data.email);
                    form.find('[name=address]').val(data.address);
                    form.find('[name=vehicle_type]').val(data.vehicle_type);
                    form.find('[name=license_plate]').val(data.license_plate);
                    form.find('[name=delivery_area]').val(data.delivery_area);
                    form.find('[name=status]').val(data.status);
                    // Cập nhật action & method
                    form.attr('action', `/admin/couriers/${id}`);
                    form.find('input[name="_method"]').val('PATCH');
                    $('#modalTitle').text('Cập nhật Shipper');
                    $('#formSubmitBtn')
                        .removeClass('btn-success').addClass('btn-primary')
                        .text('Cập nhật');
                    $('#formModal').modal('show');
                });
            });

            // Hàm validate chung cho cả Create/Update
            function validateCourierForm(form) {
                let isValid = true;
                // Xóa các lỗi cũ
                $(form).find('.is-invalid').removeClass('is-invalid');
                $(form).find('.invalid-feedback.js-error').remove();

                function markError(selector, msg) {
                    let el = $(form).find(selector);
                    el.addClass('is-invalid')
                        .after(`<div class="invalid-feedback js-error">${msg}</div>`);
                    if (isValid) el.focus();
                    isValid = false;
                }

                // user_id
                if (!$(form).find('[name=user_id]').val()) {
                    markError('[name=user_id]', 'Vui lòng chọn Shipper.');
                }
                // name
                if (!$(form).find('[name=name]').val().trim()) {
                    markError('[name=name]', 'Vui lòng nhập tên Shipper.');
                }
                // phone: 9–11 số
                let phone = $(form).find('[name=phone]').val().trim();
                if (!/^[0-9]{9,11}$/.test(phone)) {
                    markError('[name=phone]', 'Số điện thoại không hợp lệ (9–11 chữ số).');
                }
                // email (nếu có phải đúng định dạng)
                let email = $(form).find('[name=email]').val().trim();
                if (email && !/^[^@]+@[^@]+\.[^@]+$/.test(email)) {
                    markError('[name=email]', 'Email không hợp lệ.');
                }
                // vehicle_type
                if (!$(form).find('[name=vehicle_type]').val()) {
                    markError('[name=vehicle_type]', 'Vui lòng chọn loại phương tiện.');
                }
                // delivery_area
                if (!$(form).find('[name=delivery_area]').val().trim()) {
                    markError('[name=delivery_area]', 'Vui lòng nhập khu vực giao hàng.');
                }
                // status
                if (!$(form).find('[name=status]').val()) {
                    markError('[name=status]', 'Vui lòng chọn trạng thái.');
                }
                return isValid;
            }

            // Bắt sự kiện submit form chung
            $('#courierForm').on('submit', function(e) {
                if (!validateCourierForm(this)) {
                    e.preventDefault();
                }
            });

            // Xóa
            $('.delete-btn').click(function() {
                if (!confirm('Xác nhận xóa?')) return;
                let id = $(this).data('id');
                $('<form method="POST" action="/admin/couriers/' + id + '">@csrf @method('DELETE')</form>')
                    .appendTo('body').submit();
            });
        });
    </script>
@endsection
