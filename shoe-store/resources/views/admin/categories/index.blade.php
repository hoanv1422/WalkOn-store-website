@extends('admin.layouts.app')
@section('title', 'trang danh mục category')
@section('content')
<div class="main_content_iner ">
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
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form  Active="#">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Search content here......">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        <a href="{{url('categories/create')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Thêm mới</a>
                                    </div>
                                </div>
                            </div>

                            <div class="QA_table mb_30">
                                <!-- table-responsive -->
                                <table class="table lms_table_active ">
                                    <thead>
                                        <tr>
                                            <th scope="col">title</th>
                                            <th scope=  "col">Category</th>
                                            <th scope="col">Category Title</th>
                                            <th scope="col">Category Description</th>
                                            <th scope="col">Enrolled</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name </td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                            <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                            <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                            <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                            <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> title here 1</a></th>
                                            <td>Category name</td>
                                            <td>Category title</td>
                                            <td>Category Description</td>
                                            <td>16</td>
                                            <td>$25.00</td>
                                            <td><a href="#" class="status_btn">Hoạt động </a></td>
                                             <td>
                                                <button class="btn btn-success">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                <button class="btn btn-light">View</button>
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
