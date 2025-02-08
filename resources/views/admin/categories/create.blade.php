@extends('admin.layouts.app')
@section('title', 'Thêm danh mục')
@section('content')
<div class="">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">

            <div class="">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h4>Thêm mới danh mục sản phẩm</h4>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="form-label col-sm-4 col-form-label">Tên danh mục</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên danh mục tại đây...." required>
                                </div>
                            </div>
                            <fieldset class="">
                                <div class="row">
                                    <div class="col-form-label col-sm-4 pt-0">isActivate</div>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="isActivate" id="activated" value="1" checked>
                                            <label class="form-label form-check-label" for="activated">
                                                Activated
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="isActivate" id="inactive" value="0">
                                            <label class="form-label form-check-label" for="inactive">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                            <div class=" row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-plus me-1"></i> Add new
                                    </button>
                                    {{-- <div class="add_button ">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                            <i class="fas fa-plus me-1"></i> Add new
                                        </a>
                                    </div> --}}
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
