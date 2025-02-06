@extends('client.layouts.app')
@section('title', 'order-list')
@section('content')

  
@include('client.layouts.partials.menu_header')
            <div class="mainmenu-area home2 product-items">
                @include('client.layouts.partials.menu_header1')
                <div class="order-area ptb-120">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center">Danh sách đơn hàng</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($orders as $order)
                                                <tr class="text-center">
                                                    <td>#{{ $order->id }}</td>
                                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($order->status == 'pending')
                                                            <span class="badge bg-warning">Đang xử lý</span>
                                                        @elseif($order->status == 'completed')
                                                            <span class="badge bg-success">Hoàn thành</span>
                                                        @elseif($order->status == 'cancelled')
                                                            <span class="badge bg-danger">Đã hủy</span>
                                                        @endif
                                                    </td>
                                                    <td>${{ number_format($order->total, 2) }}</td>
                                                    <td>
                                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="shopping-button text-center">
                                    <a href="#" class="btn btn-secondary">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection