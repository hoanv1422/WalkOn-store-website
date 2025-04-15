@extends('admin.layouts.app')
@section('title', 'Tin nhắn liên hệ')
@section('content')
<meta name="base-url" content="{{ url('/') }}">
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Tin nhắn liên hệ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                            <li class="breadcrumb-item active">Tin nhắn liên hệ</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="customerList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Danh Sách Tin Nhắn Liên Hệ</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions"
                                        onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModalCreate"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm Tin Nhắn Liên Hệ</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form method="GET" action="{{ route('contacts.index') }}">
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" name="keyword"
                                            placeholder="Tìm kiếm theo mã, tên người dùng, email, số điện thoại..."
                                            value="{{ request('keyword') }}" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <select class="form-control" name="status">
                                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả trạng thái</option>
                                                <option value="Unread" {{ request('status') == 'Unread' ? 'selected' : '' }}>Chưa Đọc</option>
                                                <option value="Read" {{ request('status') == 'Read' ? 'selected' : '' }}>Đã Đọc</option>
                                                <option value="Replied" {{ request('status') == 'Replied' ? 'selected' : '' }}>Đã Trả Lời</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ri-equalizer-fill me-2 align-bottom"></i> Lọc
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                <table id="contactTable" class="table align-middle dataTable">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col" style="width: 15px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="contact_code">Mã Liên Hệ</th>
                                            <th class="sort" data-sort="username">Tên Tài Khoản</th>
                                            <th class="sort" data-sort="name">Tên Người Dùng</th>
                                            <th class="sort" data-sort="email">Email</th>
                                            <th class="sort" data-sort="phone">Số Điện Thoại</th>
                                            <th class="sort" data-sort="message">Tin nhắn</th>
                                            <th class="sort" data-sort="status">Trạng thái</th>
                                            <th class="sort" data-sort="response_message">Tin nhắn trả lời</th>
                                            <th class="sort" data-sort="responded_by">Trả lời bởi</th>
                                            <th class="sort" data-sort="action">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($contacts as $contact)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child">
                                                </div>
                                            </th>
                                            <td class="contact_code">{{ $contact->contact_code }}</td>
                                            <td class="username">{{ $contact->user->name ?? 'Không có' }}</td>
                                            <td class="name">{{ $contact->name }}</td>
                                            <td class="email">{{ $contact->email }}</td>
                                            <td class="phone">{{ $contact->phone }}</td>
                                            <td class="message">{{ $contact->message }}</td>
                                            <td class="status">
                                                <span class="badge
                {{ $contact->status === 'UNREAD' ? 'bg-danger-subtle text-danger' :
                ($contact->status === 'READ' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success') }}">
                                                    {{ $contact->status === 'UNREAD' ? 'CHƯA ĐỌC' :
                ($contact->status === 'READ' ? 'ĐÃ ĐỌC' : 'ĐÃ TRẢ LỜI') }}
                                                </span>
                                            </td>
                                            <td class="response_message">{{ $contact->response_message}}</td>
                                            <td class="responded_by">{{ $contact->responder->name ?? '' }}</td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <!-- View Button -->
                                                    <li class="list-inline-item edit">
                                                        <a href="#showModalEdit" data-bs-toggle="modal"
                                                            class="text-primary d-inline-block edit-item-btn"
                                                            data-id="{{ $contact->id }}"
                                                            data-contact_code="{{ $contact->contact_code }}"
                                                            data-username="{{ $contact->user->name ?? '' }}"
                                                            data-name="{{ $contact->name }}"
                                                            data-email="{{ $contact->email }}"
                                                            data-phone="{{ $contact->phone }}"
                                                            data-message="{{ $contact->message }}"
                                                            data-status="{{ $contact->status }}"
                                                            data-response_message="{{ $contact->response_message ?? 'Chưa có phản hồi' }}">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <!-- Reply Button -->
                                                    <li class="list-inline-item">
                                                        <a href="#replyModal" data-bs-toggle="modal"
                                                            class="text-success d-inline-block reply-item-btn"
                                                            data-id="{{ $contact->id }}"
                                                            data-name="{{ $contact->name }}"
                                                            data-email="{{ $contact->email }}"
                                                            data-message="{{ $contact->message }}"
                                                            data-action="{{ route('contacts.reply.send', ['id' => $contact->id]) }}">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>

                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>

                        <!-- Modal thêm tin nhắn liên hệ-->
                        <div class="modal fade" id="showModalCreate" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="{{ route('contacts.store') }}" method="POST" class="tablelist-form"
                                        autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Tên Người Dùng</label>
                                                        <input type="text" id="customername-field"
                                                            class="form-control" placeholder="Nhập tên người dùng"
                                                            name="name" />
                                                        <div class="invalid-feedback">Vui lòng nhập tên người dùng.
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="form-label">Email</label>
                                                        <input type="text" id="email-field" class="form-control"
                                                            placeholder="Nhập email" name="email" />
                                                        <div class="invalid-feedback">Vui lòng nhập email.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone-field" class="form-label">Số Điện
                                                            Thoại</label>
                                                        <input type="text" id="phone-field" class="form-control"
                                                            placeholder="Nhập số điện thoại" name="phone" />
                                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-field" class="form-label">Tin Nhắn</label>
                                                        <textarea id="message-field" class="form-control" placeholder="Nhập tin nhắn" name="message"></textarea>
                                                        <div class="invalid-feedback">Vui lòng nhập tin nhắn.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Thêm
                                                    Thông Tin Liên Hệ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- modal cập nhật trạng thái liên hệ -->
                        <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="" method="POST" class="tablelist-form edit" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="id-field-edit" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="contact-code-field-edit" class="form-label">Mã Liên Hệ</label>
                                                        <input type="text" id="contact-code-field-edit" class="form-control" name="contact_code" readonly />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name-field-edit" class="form-label">Tên Người Dùng</label>
                                                        <input type="text" id="name-field-edit" class="form-control" placeholder="Nhập tên người dùng" name="name" readonly />
                                                        <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field-edit" class="form-label">Email</label>
                                                        <input type="text" id="email-field-edit" class="form-control" placeholder="Nhập email" name="email" readonly />
                                                        <div class="invalid-feedback">Vui lòng nhập email.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone-field-edit" class="form-label">Số Điện Thoại</label>
                                                        <input type="text" id="phone-field-edit" class="form-control" placeholder="Nhập số điện thoại" name="phone" readonly />
                                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-field-edit" class="form-label">Tin Nhắn Khách Hàng</label>
                                                        <textarea id="message-field-edit" class="form-control" placeholder="Nhập tin nhắn" name="message" readonly></textarea>
                                                        <div class="invalid-feedback">Vui lòng nhập tin nhắn.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="response-message-field-edit" class="form-label">Tin Nhắn Phản Hồi Admin</label>
                                                        <textarea
                                                            id="response-message-field-edit"
                                                            class="form-control d-none"
                                                            placeholder="Nhập tin nhắn phản hồi"
                                                            name="response_message"
                                                            readonly></textarea>
                                                        <div class="invalid-feedback">Vui lòng nhập tin nhắn.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                <!-- <button type="submit" class="btn btn-success" disabled>Cập Nhật Trạng Thái Tin Nhắn Liên Hệ</button> -->
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Modal reply email -->
                        <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <form method="POST" action="#" id="replyForm">
                                        @csrf
                                        <input type="hidden" id="reply-contact-id" name="contact_id">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Phản Hồi Liên Hệ Khách Hàng </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tên người dùng:</strong> <span id="reply-contact-name"></span></p>
                                            <p><strong>Email:</strong> <span id="reply-contact-email"></span></p>
                                            <div class="mb-3">
                                                <label for="reply-customer-message" class="form-label">Tin nhắn của khách hàng:</label>
                                                <p id="reply-customer-message" class="form-control-plaintext"></p>
                                            </div>
                                            <div class="mb-3">
                                                <label for="reply-message" class="form-label">Nội dung phản hồi</label>
                                                <textarea name="response_message" id="reply-message" class="form-control" rows="5" placeholder="Nhập nội dung phản hồi..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Gửi tin nhắn qua email</button>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- xóa delete -->
                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" id="deleteRecord-close"
                                            data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#f7b84b,secondary:#f06548"
                                                style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Bạn có chắc không ?</h4>
                                                <p class="text-muted mx-4 mb-0">Bạn có muốn xóa người dùng này không ?
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                            <button type="button" class="btn w-sm btn-light"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <form id="deleteForm" method="POST" action="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn w-sm btn-danger" disabled
                                                    id="delete-record">Xóa!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal -->
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection

@section('script')

<script>
    var contacts = @json($validateContact ?? []);
</script>
<script src="{{ asset('templates/admin/assets/libs/gallery/gallery.js') }}"></script>
<script src="{{ asset('templates/admin/assets/libs/validates/contact.js') }}"></script>
<script>
    $(document).ready(function() {
        $('table.dataTable').each(function() {
            $(this).DataTable({
                "paging": true, // Hiển thị phân trang
                "searching": false, // Tắt tìm kiếm
                "ordering": true, // Bật sắp xếp
                "info": true, // Hiển thị thông tin tổng
                "pageLength": 10, // Giới hạn số lượng bản ghi mỗi trang
                "lengthChange": false
            });
        });
    });

    $(document).on('click', '.remove-item-btn', function() {
        let userId = $(this).data('id'); // Lấy ID người dùng
        let actionUrl = "/admin/users/" + userId; // Tạo URL xóa

        $('#deleteForm').attr('action', actionUrl); // Cập nhật action của form
    });

    document.addEventListener("DOMContentLoaded", function() {
        const checkAll = document.getElementById("checkAll");
        const checkboxes = document.querySelectorAll('input[name="chk_child"]');

        checkAll.addEventListener("change", function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = checkAll.checked;
            });
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                checkAll.checked = [...checkboxes].every(chk => chk.checked);
            });
        });
    });
</script>

@endsection
