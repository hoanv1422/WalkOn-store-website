<!-- Updated Comment Section with Bootstrap -->
<div class="card-body">
    <!-- Add New Comment Form -->
    @auth
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="m-2">Viết đánh giá của bạn</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" id="comment-form">
                    @csrf
                    <input type="hidden" value="" id="slug-comment">
                    <div id="form-errors" class="alert alert-danger d-none mb-3">
                        <ul class="mb-0 ps-3"></ul>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Đánh giá</label>
                        <div class="rating-input">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="rating" id="rating1" value="1"
                                    required>
                                <label class="btn btn-outline-warning" for="rating1"><i class="fa fa-star"></i>
                                    1</label>

                                <input type="radio" class="btn-check" name="rating" id="rating2" value="2">
                                <label class="btn btn-outline-warning" for="rating2"><i class="fa fa-star"></i>
                                    2</label>

                                <input type="radio" class="btn-check" name="rating" id="rating3" value="3">
                                <label class="btn btn-outline-warning" for="rating3"><i class="fa fa-star"></i>
                                    3</label>

                                <input type="radio" class="btn-check" name="rating" id="rating4" value="4">
                                <label class="btn btn-outline-warning" for="rating4"><i class="fa fa-star"></i>
                                    4</label>

                                <input type="radio" class="btn-check" name="rating" id="rating5" value="5">
                                <label class="btn btn-outline-warning" for="rating5"><i class="fa fa-star"></i>
                                    5</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment-content" class="form-label">Nội dung đánh giá</label>
                        <textarea class="form-control" id="comment-content" name="content" rows="3"></textarea>
                        <input type="file" name="image[]" class="form-control mt-2" style="width: 119px" multiple>
                    </div>
                    <div class="col-md-4">
                        <div id="image-preview" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
                <div id="form-message" class="mt-3"></div>

            </div>
        </div>
    @else
        <div class="text-center">
            <a class=" btn btn-danger" href="{{ route('login.form') }}">Bạn phải đăng nhập mới được bình luận</a>
        </div>
    @endauth

    <!-- Average Rating Display -->
    <div class="m-3 avg_rating">
        <div class="product-average-rating d-flex gap-2">
            <div class="product-rating-stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <span class="product-rating-value">0</span>
            (<span class="product-review-count">0</span>đánh giá)
        </div>
    </div>

    <!-- Filter Form -->
    <form class="row g-3 align-items-center mb-4">
        <div class="col-auto">
            <label for="rating" class="col-form-label">Lọc theo đánh giá:</label>
        </div>
        <div class="col-auto">
            <select name="rating" id="rating" class="form-select form-select-sm">
                <option value="">Tất cả</option>
                <option value="1">1 sao</option>
                <option value="2">2 sao</option>
                <option value="3">3 sao</option>
                <option value="4">4 sao</option>
                <option value="5">5 sao</option>
            </select>
        </div>
    </form>


    <!-- Comments Container -->
    <div id="comments-container" class="mt-3">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
        </div>
        <p class="text-center mt-2">Đang tải bình luận...</p>
    </div>
</div>
