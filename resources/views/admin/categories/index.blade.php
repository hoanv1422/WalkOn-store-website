@extends('admin.layouts.app')
@section('title', 'trang danh mục category')
@section('content')
<div class="">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Danh sách </h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Danh sách danh mục sản phẩm</h4>
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
                                    <a href="{{url('categories/create')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-plus me-1"></i> Add new
                                    </a>
                                </div>
                                <!-- table-responsive -->
                                <table class="table lms_table_active text-center">
                                    <thead class="">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">isActive</th>
                                            <th scope="col">Created_at</th>
                                            <th scope="col">Update_at</th>
                                            <th scope="col">Tính năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Category name </td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <!-- page 2 -->
                                        <tr>
                                            <td>11</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
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
