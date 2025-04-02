<!-- Bắt đầu tab sản phẩm đơn -->
<div class="single-product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-product-tab">
                    <ul class="nav single-product-tab-navigation" role="tablist">
                        <li role="presentation">
                            <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                data-bs-toggle="tab">Mô tả sản phẩm</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">Đánh giá</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab3" aria-controls="tab3" role="tab" data-bs-toggle="tab">Thẻ sản phẩm</a>
                        </li>
                    </ul>

                    <!-- Nội dung tab -->
                    <div class="tab-content single-product-page">
                        <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                            <div class="single-p-tab-content">
                                {!! $product->description !!}
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2">
                            <div class="single-p-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="product-review">
                                            <p> <a href="#"> plaza</a> <span>Đánh giá bởi</span> plaza </p>
                                            <div class="product-rating-info">
                                                <p>Giá trị</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="product-rating-info">
                                                <p>Chất lượng</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="product-rating-info">
                                                <p>Giá cả</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="review-date">
                                                <p>plaza <em> (Đăng vào ngày 8/27/2015)</em></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="rate-product hidden-xs">
                                            <div class="rate-product-heading">
                                                <h3>Bạn đang đánh giá: Fusce aliquam</h3>
                                                <h3>Bạn đánh giá sản phẩm này như thế nào? <em>*</em></h3>
                                            </div>
                                            <form action="#">
                                                <table class="product-review-table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>1 sao</th>
                                                            <th>2 sao</th>
                                                            <th>3 sao</th>
                                                            <th>4 sao</th>
                                                            <th>5 sao</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Giá cả</th>
                                                            <td> <input type="radio" class="radio" name="ratings[1]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[1]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[1]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[1]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[1]">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Giá trị</th>
                                                            <td> <input type="radio" class="radio" name="ratings[2]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[2]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[2]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[2]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[2]">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Chất lượng</th>
                                                            <td> <input type="radio" class="radio" name="ratings[3]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[3]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[3]"> </td>
                                                            <td> <input type="radio" class="radio" name="ratings[3]"> </td>
                                                            <td> <input type="radio" class="radio" name="ratings[3]"> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="form-list">
                                                    <li>
                                                        <label> Biệt danh <em>*</em> </label>
                                                        <input type="text">
                                                    </li>
                                                    <li>
                                                        <label> Tóm tắt đánh giá của bạn <em>*</em> </label>
                                                        <input type="text">
                                                    </li>
                                                    <li>
                                                        <label> Đánh giá <em>*</em> </label>
                                                        <textarea cols="3" rows="5"></textarea>
                                                    </li>
                                                </ul>
                                                <button type="submit"> Gửi đánh giá</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab3">
                            <div class="single-p-tab-content">
                                <div class="add-tab-title">
                                    <p> Thêm thẻ của bạn </p>
                                </div>
                                <div class="add-tag">
                                    <form action="#">
                                        <input type="text">
                                        <button type="submit">Thêm thẻ</button>
                                    </form>
                                </div>
                                <p class="tag-rules">Sử dụng dấu cách để tách các thẻ. Dùng dấu nháy đơn (') cho cụm từ.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- Kết thúc tab sản phẩm đơn -->

