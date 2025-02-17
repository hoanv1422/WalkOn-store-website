<!-- single product tab start -->
<div class="single-product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-product-tab">
                    <ul class="nav single-product-tab-navigation" role="tablist">
                        <li role="presentation">
                            <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                data-bs-toggle="tab">Product Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">reviews</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab3" aria-controls="tab3" role="tab" data-bs-toggle="tab">product tag</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content single-product-page">
                        <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                            <div class="single-p-tab-content">
{{-- <<<<<<< HEAD --}}
                                <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate,
                                    tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus
                                    orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue.
                                    Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt.
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                    himenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis.
                                    Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui
                                    vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc
                                    mattis lobortis. </p>
                                {{ $product->description }}
{{-- >>>>>>> hoa_dev --}}
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2">
                            <div class="single-p-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="product-review">
                                            <p> <a href="#"> plaza</a> <span>Review by</span> plaza </p>
                                            <div class="product-rating-info">
                                                <p>value</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="product-rating-info">
                                                <p>Quality</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="product-rating-info">
                                                <p>Price</p>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
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
                                                <h3>You're reviewing: Fusce aliquam</h3>
                                                <h3>How do you rate this product? <em>*</em></h3>
                                            </div>
                                            <form action="#">
                                                <table class="product-review-table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>1 star</th>
                                                            <th>2 star</th>
                                                            <th>3 star</th>
                                                            <th>4 star</th>
                                                            <th>5 star</th>
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
                                                        <tr>
                                                            <th>Value</th>
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
                                                            <th>Quality</th>
                                                            <td> <input type="radio" class="radio" name="ratings[3]">
                                                            </td>
                                                            <td> <input type="radio" class="radio" name="ratings[3]">
                                                            </td>
                                                            <td> <input type="radio" class="radio"
                                                                    name="ratings[3]"> </td>
                                                            <td> <input type="radio" class="radio"
                                                                    name="ratings[3]"> </td>
                                                            <td> <input type="radio" class="radio"
                                                                    name="ratings[3]"> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="form-list">
                                                    <li>
                                                        <label> nickname <em>*</em> </label>
                                                        <input type="text">
                                                    </li>
                                                    <li>
                                                        <label> Summary of Your Review <em>*</em> </label>
                                                        <input type="text">
                                                    </li>
                                                    <li>
                                                        <label> Review <em>*</em> </label>
                                                        <textarea cols="3" rows="5"></textarea>
                                                    </li>
                                                </ul>
                                                <button type="submit"> submit review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
