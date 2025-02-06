@extends('admin.layouts.app')
@section('title', 'Thêm sản phẩm')
@section('content')
<div class="">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">

            <div class="">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h4>Thêm mới sản phẩm</h4>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{url('admin/products/')}}" method="POST">
                            <div class="mb-3 row">
                                <label for="product_name" class="form-label col-sm-4 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" placeholder="Điền tên sản phẩm tại đây...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="slug" class="form-label col-sm-4 col-form-label">Slug </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="slug"
                                        placeholder="Slug sản phẩm tại đây...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="form-label col-sm-4 col-form-label">Giá</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="price"
                                        placeholder="Điền giá sản phẩm tại đây...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="quantity" class="form-label col-sm-4 col-form-label">Số lượng </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="quantity"
                                        placeholder="Điền số lượng sản phẩm tại đây...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="form-label col-sm-4 col-form-label">Mô tả</label>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" id="description"
                                        placeholder="Điền mô tả phẩm tại đây......"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="SKU" class="form-label col-sm-4 col-form-label">SKU </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="SKU"
                                        placeholder="Điền Sku sản phẩm tại đây...">
                                </div>
                            </div>
                            <fieldset class="">
                                <div class="row">
                                    <div class="col-form-label col-sm-4 pt-0">Trạng thái</div>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="activated">
                                            <label class="form-label form-check-label" for="gridRadios1">
                                                Còn hàng
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="inactive">
                                            <label class="form-label form-check-label" for="gridRadios2">
                                                Hết hàng
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            <div class=" row">
                                <div class="col-sm-10">
                                    <div class="add_button ">
                                        <a href="{{url('admin/products/')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                            <i class="fas fa-plus me-1"></i> Add new
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
