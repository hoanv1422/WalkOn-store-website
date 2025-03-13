@extends('admin.layouts.app')
@section('title', 'Bình luận')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">

    <!-- gridjs css -->
     <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> 

@endsection 
@section('content')
<div class="container">
    <h2>Quản lý Bình luận</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Rating</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->product->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->rating }}</td>
                    <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                          
                            <form action="{{ route('comments.hide', $comment->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn muốn ẩn bình luận này?')">Ẩn</button>
                            </form>
                    </td>
                </tr>
                {{-- @foreach($comment->replies as $reply)
                    <tr>
                        <td>↳ {{ $reply->id }}</td>
                        <td>{{ $reply->user->name }}</td>
                        <td>{{ $reply->product->name }}</td>
                        <td>{{ $reply->content }}</td>
                        <td>{{ $reply->rating }}</td>
                        <td>{{ $reply->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('comments.destroy', $reply->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach --}}
            @endforeach
        </tbody>
    </table>

    {{ $comments->links() }}
</div>
@endsection
