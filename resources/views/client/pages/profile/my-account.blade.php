<div class="account-area">
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
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="account-title">
                                                <h4>Đây là các đơn hàng bạn đã đặt kể từ khi tài khoản của bạn được tạo.
                                                </h4>
                                            </div>
                                            <div class="order-history">
                                                <!-- Kiểm tra đơn hàng trống -->
                                                @if ($orders->isEmpty())
                                                    <p>Bạn chưa đặt đơn hàng nào.</p>
                                                @else
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Mã đơn hàng</th>
                                                                <th>Ngày đặt</th>
                                                                <th>Tổng giá</th>
                                                                <th>Trạng thái</th>
                                                                <th>Chi tiết</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->order_code }}</td>
                                                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                                    <td>{{ number_format($order->total_price) }} VND
                                                                    </td>
                                                                    <td>{{ $order->order_status }}</td>
                                                                    <td>
                                                                        <!-- Nút để hiển thị chi tiết đơn hàng -->
                                                                        <button class="btn btn-primary"
                                                                            data-toggle="collapse"
                                                                            data-target="#order-{{ $order->id }}">
                                                                            Xem Chi tiết
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <!-- Chi tiết đơn hàng -->
                                                                <tr id="order-{{ $order->id }}" class="collapse">
                                                                    <td colspan="5">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Tên sản phẩm</th>
                                                                                    <th>SKU</th>
                                                                                    <th>Giá</th>
                                                                                    <th>Số lượng</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($order->orderItems as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->product_name }}
                                                                                        </td>
                                                                                        <td>{{ $item->product_sku }}
                                                                                        </td>
                                                                                        <td>{{ number_format($item->product_price) }}
                                                                                            VND</td>
                                                                                        <td>{{ $item->quantity }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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
                                    <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
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
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                        href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="fa fa-user"></i>
                                        Thông tin cá nhân của tôi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFour" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="delivery-details">
                                            <form action="#">
                                                <div class="list-style">
                                                    <div class="account-title">
                                                        <h4>Hãy chắc chắn cập nhật thông tin cá nhân của bạn nếu nó đã
                                                            thay đổi.</h4>
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Tên <em>*</em> </label>
                                                        <input type="text" placeholder="Tên">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Họ <em>*</em> </label>
                                                        <input type="text" placeholder="Họ">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Công ty </label>
                                                        <input type="text" placeholder="Công ty">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Địa chỉ 1 <em>*</em> </label>
                                                        <input type="text" placeholder="Địa chỉ 1">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Địa chỉ 2 </label>
                                                        <input type="text" placeholder="Địa chỉ 2">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Thành phố <em>*</em> </label>
                                                        <input type="text" placeholder="Thành phố">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Mã bưu điện <em>*</em> </label>
                                                        <input type="text" placeholder="Mã bưu điện">
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Quốc gia <em>*</em> </label>
                                                        <select>
                                                            <option value="1">---Vui lòng chọn---</option>
                                                            <option value="1">Afghanistan</option>
                                                            <option value="1">Algeria</option>
                                                            <option value="1">American Samoa</option>
                                                            <option value="1">Australia</option>
                                                            <option value="1">Bangladesh</option>
                                                            <option value="1">Belgium</option>
                                                            <option value="1">Bosnia and Herzegovina</option>
                                                            <option value="1">Chile</option>
                                                            <option value="1">China</option>
                                                            <option value="1">Egypt</option>
                                                            <option value="1">Finland</option>
                                                            <option value="1">France</option>
                                                            <option value="1">United State</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-name">
                                                        <label>Bang </label>
                                                        <select>
                                                            <option value="1">---Vui lòng chọn---</option>
                                                            <option value="1">Arizona</option>
                                                            <option value="1">Armed Forces Africa</option>
                                                            <option value="1">California</option>
                                                            <option value="1">Florida</option>
                                                            <option value="1">Indiana</option>
                                                            <option value="1">Marshall Islands</option>
                                                            <option value="1">Minnesota</option>
                                                            <option value="1">New Mexico</option>
                                                            <option value="1">Utah</option>
                                                            <option value="1">Virgin Islands</option>
                                                            <option value="1">West Virginia</option>
                                                            <option value="1">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="save-button">
                                                        <button>lưu</button>
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
                        <div class="home"> <a href="index.html"> trang chủ</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
