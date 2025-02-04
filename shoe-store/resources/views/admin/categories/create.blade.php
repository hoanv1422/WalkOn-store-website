@extends('admin.layouts.app')
@section('title', 'Thêm danh mục')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">

                <div class="col-lg-9">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Thêm Mới Danh Mục</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            {{-- <h6 class="card-subtitle mb-2">Create horizontal forms with the grid by adding the <code
                                    class="highlighter-rouge">.row</code> class to form groups and using the <code
                                    class="highlighter-rouge">.col-*-*</code> classes to specify the width of your labels
                                and controls. Be sure to add <code class="highlighter-rouge">.col-form-label</code> to your
                                <code class="highlighter-rouge">&lt;label&gt;</code>s as well so they’re vertically centered
                                with their associated form controls.</h6> --}}
                            <form action="{{url('/')}}" method="">
                                <div class="mb-3 row">
                                    <label for="name" class="form-label col-sm-4 col-form-label">Tên danh mục</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" placeholder="Tên danh mục....">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="form-label col-sm-4 col-form-label">Tiêu đề danh mục</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title"
                                            placeholder="Tiêu đề....">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="form-label col-sm-4 col-form-label">Mô tả danh mục</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="description"
                                            placeholder="Mô tả....">
                                    </div>
                                </div>
                                <fieldset class="">
                                    <div class="row">
                                        <div class="col-form-label col-sm-4 pt-0">Radios</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="gridRadios1" value="option1" checked="">
                                                <label class="form-label form-check-label" for="gridRadios1">
                                                    First radio
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="gridRadios2" value="option2">
                                                <label class="form-label form-check-label" for="gridRadios2">
                                                    Second radio
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <input class="form-check-input" type="radio"
                                                    id="gridRadios3" value="option3" disabled="">
                                                <label class="form-label form-check-label" for="gridRadios3">
                                                    Third disabled radio
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class=" row">
                                    <div class="col-sm-4">Trạng thái</div>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                                            <label class="form-label form-check-label" for="gridCheck1">
                                                Hiển thị danh mục
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
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
