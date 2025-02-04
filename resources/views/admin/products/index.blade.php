@extends('admin.layouts.app')
@section('title', 'trang sản phẩm produc')
@section('content')
<div class="">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Danh sách</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Danh sách sản phẩm</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="search_field_2">
                                        <div class="search_inner">
                                            <form action="#" class="d-flex">
                                                <input type="text" class="form-control" placeholder="Search here..." aria-label="Search">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="QA_table mb_30">
                                <div class="add_button ">
                                    <a href="{{url('products/create')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-plus me-1"></i> Add new
                                    </a>
                                </div>
                                <!-- table-responsive -->
                                <table class="table lms_table_active text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Giảm giá</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Số lượng đã bán</th>
                                            <th scope="col">Tính năng</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>SALE001</td>
                                            <td>Product name</td>
                                            <td>product-name</td>
                                            <td>Description name</td>
                                            <td style="text-decoration: line-through;">99.000 VND</td>
                                            <td>49.000 VND</td>
                                            <td><img src="img/adidas_sport.png  " alt="err" width="100" height="100" /></td>
                                            <td class="text-danger small fw-semibold">321</td>
                                            <td class="text-danger small fw-semibold">320</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{url('products/edit')}}">
                                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                                </a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                                <td />
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>SALE001</td>
                                            <td>Product name</td>
                                            <td>product-name</td>
                                            <td>Description name</td>
                                            <td style="text-decoration: line-through;">99.000 VND</td>
                                            <td>49.000 VND</td>
                                            <td><img src="img/adidas_sport.png  " alt="err" width="100" height="100" /></td>
                                            <td class="text-danger small fw-semibold">321</td>
                                            <td class="text-danger small fw-semibold">123</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{url('products/edit')}}">
                                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                                </a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>SALE001</td>
                                            <td>Product name</td>
                                            <td>product-name</td>
                                            <td>Description name</td>
                                            <td style="text-decoration: line-through;">99.000 VND</td>
                                            <td>49.000 VND</td>
                                            <td><img src="img/adidas_sport.png  " alt="err" width="100" height="100" /></td>
                                            <td class="text-danger small fw-semibold">321</td>
                                            <td class="text-danger small fw-semibold">123</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{url('products/edit')}}">
                                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                                </a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>SALE001</td>
                                            <td>Product name</td>
                                            <td>product-name</td>
                                            <td>Description name</td>
                                            <td style="text-decoration: line-through;">99.000 VND</td>
                                            <td>49.000 VND</td>
                                            <td><img src="img/adidas_sport.png  " alt="err" width="100" height="100" /></td>
                                            <td class="text-danger small fw-semibold">321</td>
                                            <td class="text-danger small fw-semibold">123</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{url('products/edit')}}">
                                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                                </a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">

            </div>
        </div>
    </div>
</div>
@endsection
