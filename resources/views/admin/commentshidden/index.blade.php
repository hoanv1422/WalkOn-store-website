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
    <h2>Quản lý Bình luận Ẩn</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Comment_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hiddenComments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->comment_id }}</td>

            @endforeach
        </tbody>
    </table>

    {{-- {{ $comments->links() }} --}}
</div>
@endsection
