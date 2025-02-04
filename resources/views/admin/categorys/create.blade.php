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
                            <form action="" method="post">
                                <div class="mb-3 row">
                                    <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword3" class="form-label col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <fieldset class="">
                                    <div class="row">
                                        <div class="col-form-label col-sm-4 pt-0">Radios</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                    id="gridRadios1" value="option1" checked="">
                                                <label class="form-label form-check-label" for="gridRadios1">
                                                    First radio
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                    id="gridRadios2" value="option2">
                                                <label class="form-label form-check-label" for="gridRadios2">
                                                    Second radio
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                    id="gridRadios3" value="option3" disabled="">
                                                <label class="form-label form-check-label" for="gridRadios3">
                                                    Third disabled radio
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class=" row">
                                    <div class="col-sm-4">Checkbox</div>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                                            <label class="form-label form-check-label" for="gridCheck1">
                                                Example checkbox
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Sign in</button>
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
