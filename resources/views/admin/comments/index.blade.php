@extends('admin.layouts.app')
@section('title', 'BINH LUAN')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">

    <!-- gridjs css -->
    {{-- <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> --}}

@endsection

@section('content')



    <div class="page-content">
        <div class="container-fluid">
            <div class="">
            <h2>Quản lý Bình luận</h2>

            <form action="{{ route('admincomments.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <!-- Lọc theo sản phẩm -->
                    <div class="col-md-3">
                        <label for="product_id">Sản phẩm</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option value="">Tất cả</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lọc theo người dùng -->
                    <div class="col-md-3">
                        <label for="user_id">Người dùng</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">Tất cả</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lọc theo trạng thái bình luận -->
                    <div class="col-md-3">
                        <label for="hidden_comment">Trạng thái</label>
                        <select name="hidden_comment" id="hidden_comment" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="0" {{ request('hidden_comment') == '0' ? 'selected' : '' }}>Hiển thị
                            </option>
                            <option value="1" {{ request('hidden_comment') == '1' ? 'selected' : '' }}>Đã ẩn</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="rating">Số đánh giá</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3">Lọc</button>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Sản phẩm</th>
                        <th>Nội dung</th>
                        <th>Rating</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                        <th>Trạng Thái</th>
                        <th>Admin xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->product->name }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->rating }}</td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($comment->hidden_comment == 0)
                                    <!-- Nếu đang hiển thị: cho phép ẩn -->
                                    <form action="{{ route('comments.hide', $comment->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning"
                                            onclick="return confirm('Bạn có chắc chắn muốn ẩn bình luận này?')">Ẩn</button>
                                    </form>
                                @else
                                    <!-- Nếu đang bị ẩn: cho phép hiển thị lại -->
                                    <form action="{{ route('admin.comments.unhide', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success"
                                            onclick="return confirm('Bạn có chắc chắn muốn hiển thị lại bình luận này?')">Hiển
                                            thị lại</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if ($comment->hidden_comment == 1)
                                    <span class="badge bg-danger">Đã ẩn</span> <!-- Hiển thị trạng thái ẩn -->
                                @else
                                    <span class="badge bg-success">Hiển thị</span> <!-- Hiển thị trạng thái hiển thị -->
                                @endif
                            </td>

                            <td>{{ $comment->last_admin_username ?? 'Không có thông tin' }}</td>
                            <!-- Hiển thị tên admin đã thay đổi -->
                        </tr>
                    @endforeach


                </tbody>
            </table>
         </div>
        </div>
    </div>
    {{-- {{ $comments->links() }}  --}}
@endsection

@section('script')
    <!-- nouisliderribute js -->
    <script src="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>


    <!-- gridjs js -->
    {{-- <script src="{{ asset('templates/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script> --}}
    <script src="../../../../unpkg.com/gridjs%406.2.0/plugins/selection/dist/selection.umd.js"></script>
    <!-- ecommerce product list -->

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

        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            // var itemId = $(this).data('id'); 

            $('#deleteForm').attr('action', actionUrl);
            // $('#deleteItemId').val(itemId); 
        });
    </script>
    {{-- <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
@endsection
