<!-- single product tab start -->
<div class="single-product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-product-tab">
                    <ul class="nav single-product-tab-navigation" role="tablist">
                        <li role="presentation">
                            <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                data-bs-toggle="tab">ĐÁNH GIÁ</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">GHI CHÚ</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab3" aria-controls="tab3" role="tab" data-bs-toggle="tab">product tag</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content single-product-page">
                        <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                            <div class="single-p-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="product-review">
                                            <p>  <span>Đánh giá của khách hàng</span>  </p>
                                            <div class="product-rating-info">
                                                <p>Sản Phẩm:</p>
                                                <div class="ratings">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= floor($product->average_rating))
                                                            <i class="fa fa-star"></i>
                                                        @elseif($i - 0.5 == $product->average_rating)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor   
                                                </div>
                                            </div>
                                            
                                            <div class="review-date">
                                                <p>plaza <em> (Posted on 8/27/2015)</em></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="rate-product hidden-xs">
                                            <div class="rate-product-heading">
                                                <h3>Bạn đang đánh giá:  <span style="font-weight: bold"> {{$product->name}} </span></h3>
                                                <h3>Bạn đánh giá sản phẩm này thế nào? <em>*</em></h3>
                                            </div>
                                            <form action="#">
                                                <table class="product-review-table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>1 <i class="fa fa-star ratings" style="color: #eea62b"></i></th>
                                                            <th>2 <i class="fa fa-star ratings" style="color: #eea62b"></i></th>
                                                            <th>3 <i class="fa fa-star ratings" style="color: #eea62b"></i></th>
                                                            <th>4 <i class="fa fa-star ratings" style="color: #eea62b"></i></th>
                                                            <th>5 <i class="fa fa-star ratings" style="color: #eea62b"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Price</th>
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
                                                        
                                                    </tbody>
                                                </table>
                                                <ul class="form-list">
                                                  
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
                        <div role="tabpanel" class="tab-pane fade" id="tab2">
                            <div class="single-p-tab-content">
                                {!! $product->description !!}
                            </div>
                            
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab3">
                            <div class="single-p-tab-content">
                                <div class="add-tab-title">
                                    <p> add your tag </p>
                                </div>
                                <div class="add-tag">
                                    <form action="#">
                                        <input type="text">
                                        <button type="submit">add tags</button>
                                    </form>
                                </div>
                                <p class="tag-rules">Use spaces to separate tags. Use single quotes (') for phrases.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single product tab end -->
