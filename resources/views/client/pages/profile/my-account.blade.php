<div class="account-area">
    <!-- Hiển thị thông báo -->
    @if (session('success') || session('error'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fa fa-check-circle me-2"></i>
                            <strong>Thành công!</strong> {{ session('success') }}
                            @if (session('updatedFields'))
                                <ul class="mt-2 mb-0">
                                    @foreach (session('updatedFields') as $field)
                                        <li><i class="fa fa-check"></i> {{ $field }} đã được cập nhật.</li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>
                            <strong>Lỗi!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Tùy chọn mua sắm</h2>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Danh mục</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Màu sắc</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                @foreach ($colors as $color)
                                    <li><a href="#">{{ $color->color }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="my-account-accordion">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!--Hiển thị lịch sử mua hàng của người dùng-->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="fa fa-list-ol"></i>
                                        Lịch sử và chi tiết đơn hàng
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel"
                                aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="account-title">
                                                <h4>Đây là các đơn hàng bạn đã đặt kể từ khi tài khoản của bạn được tạo.
                                                </h4>
                                            </div>
                                            <div class="order-history">
                                                @if ($orders->isEmpty())
                                                    <p class="text-muted text-center">Bạn chưa đặt đơn hàng nào.</p>
                                                @else
                                                    <div class="card shadow-lg border-0">
                                                        <div class="card-body bg-white">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-bordered align-middle text-center">
                                                                    <thead class="table-light">
                                                                        <tr class="fw-bold">
                                                                            <th class="bg-white">Mã đơn hàng</th>
                                                                            <th class="bg-white">Ngày đặt</th>
                                                                            <th class="bg-white">Tổng giá</th>
                                                                            <th class="bg-white">Trạng thái</th>
                                                                            <th class="bg-white">Chi tiết</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($orders as $order)
                                                                            <tr>
                                                                                <td>{{ $order->order_code }}</td>
                                                                                <td>{{ $order->created_at->format('d/m/Y') }}
                                                                                </td>
                                                                                <td class="fw-bold text-danger">
                                                                                    {{ number_format($order->total_price) }}
                                                                                    VND
                                                                                </td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge
                                                                                    @if ($order->order_status == 'Đã giao') bg-success
                                                                                    @elseif($order->order_status == 'Đang xử lý') bg-warning text-dark
                                                                                    @else bg-secondary @endif">
                                                                                        {{ $order->order_status }}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <button
                                                                                        class="btn btn-outline-primary btn-sm"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#order-{{ $order->id }}">
                                                                                        <i class="fa fa-eye"></i> Xem
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- Chi tiết đơn hàng -->
                                                                            <tr id="order-{{ $order->id }}"
                                                                                class="collapse">
                                                                                <td colspan="5">
                                                                                    <div
                                                                                        class="card card-body border-light bg-white">
                                                                                        <h6
                                                                                            class="text-muted text-center">
                                                                                            Chi tiết đơn hàng</h6>
                                                                                        <table
                                                                                            class="table table-bordered table-sm">
                                                                                            <thead class="table-light">
                                                                                                <tr class="fw-bold">
                                                                                                    <th
                                                                                                        class="bg-white">
                                                                                                        Ảnh sản phẩm
                                                                                                    </th>
                                                                                                    <th
                                                                                                        class="bg-white">
                                                                                                        Tên sản phẩm
                                                                                                    </th>
                                                                                                    <th
                                                                                                        class="bg-white">
                                                                                                        Mã Sản phẩm</th>
                                                                                                    <th
                                                                                                        class="bg-white">
                                                                                                        Giá</th>
                                                                                                    <th
                                                                                                        class="bg-white">
                                                                                                        Số lượng</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($order->orderItems as $item)
                                                                                                    <tr>
                                                                                                        <td><img src="{{ Storage::url($item->product_image) }}"
                                                                                                                alt="{{ $item->product_name }}"
                                                                                                                style="width: 50px; height: 50px;">
                                                                                                        </td>
                                                                                                        <td>{{ $item->product_name }}
                                                                                                        </td>
                                                                                                        <td>{{ $item->product_sku }}
                                                                                                        </td>
                                                                                                        <td>{{ number_format($item->product_price) }}
                                                                                                            VND</td>
                                                                                                        <td>{{ $item->quantity }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Other panels -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-file-o"></i>
                                        Phiếu tín dụng của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="account-title">
                                                <h4>Phiếu tín dụng bạn đã nhận sau khi hủy đơn hàng.</h4>
                                            </div>
                                            <div class="credit-slips">
                                                <p>Bạn chưa nhận được phiếu tín dụng nào.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-building-o"></i>
                                        Địa chỉ của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingThree" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="my-address">
                                                <p>Vui lòng cấu hình địa chỉ thanh toán và giao hàng mặc định của bạn
                                                    khi đặt hàng. Bạn cũng có thể thêm các địa chỉ khác, điều này có thể
                                                    hữu ích cho việc gửi quà hoặc nhận đơn hàng tại văn phòng của bạn.
                                                </p>
                                                <div class="account-title">
                                                    <h4>Địa chỉ của bạn được liệt kê dưới đây.</h4>
                                                </div>
                                                <p>Hãy chắc chắn cập nhật thông tin cá nhân của bạn nếu nó đã thay đổi.
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="account-address">
                                                            <ul>
                                                                <li class="address-menu-title">Địa chỉ của tôi</li>
                                                                <li>Hridoy roy</li>
                                                                <li>Chuyên gia</li>
                                                                <li>Bristol</li>
                                                                <li>Manchester1</li>
                                                                <li>Bristol</li>
                                                                <li>Vương quốc Anh</li>
                                                                <li>2334234</li>
                                                                <li>454565768678</li>
                                                                <li>
                                                                    <button> cập nhật </button>
                                                                    <button> gửi </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-address">
                                                    <button>thêm địa chỉ mới</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hiển thị thông tin người dùng-->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                        href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="fa fa-user"></i> Thông tin cá nhân của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFour" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="delivery-details">
                                            <!-- Form để cập nhật thông tin người dùng -->
                                            <form action="{{ route('profile.update') }}" method="POST"
                                                class="container mt-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="card shadow-lg">
                                                    <div class="card-body">
                                                        <p class="text-muted">Hãy chắc chắn cập nhật thông tin cá nhân
                                                            của bạn nếu nó đã thay đổi.</p>
                                                        <div class="row">
                                                            <!-- Tên đăng nhập (readonly) -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Tên đăng
                                                                        nhập <em>*</em></label>
                                                                    <input type="text" class="form-control"
                                                                        id="username" name="username"
                                                                        value="{{ $user->username }}" readonly>
                                                                </div>
                                                            </div>
                                                            <!-- Email (readonly) -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email
                                                                        <em>*</em></label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" name="email"
                                                                        value="{{ $user->mail }}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Tên người dùng -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Tên người
                                                                        dùng <em>*</em></label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="name"
                                                                        value="{{ $user->name }}">
                                                                </div>
                                                            </div>
                                                            <!-- Số điện thoại -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="phone" class="form-label">Số điện
                                                                        thoại <em>*</em></label>
                                                                    <input type="text" class="form-control"
                                                                        id="phone" name="phone"
                                                                        value="{{ $user->phone }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Địa chỉ -->
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Địa chỉ
                                                                <em>*</em></label>
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" value="{{ $user->address }}">
                                                        </div>
                                                        <!-- Nút lưu thông tin -->
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-primary px-4">Cập
                                                                nhật</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                        href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <i class="fa fa-heart"></i>
                                        Danh sách yêu thích của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFive" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="wishlist-container">
                                            <h3>Danh sách yêu thích mới</h3>
                                            <form action="#">
                                                <label>Tên</label>
                                                <input type="text">
                                                <div class="save-button">
                                                    <button type="submit">lưu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-button">
                        <div class="back-btn"> <a href="#">Quay lại tài khoản của bạn</a> </div>
                        <div class="home">
                            <a href="{{ route('home.index') }}">Trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
