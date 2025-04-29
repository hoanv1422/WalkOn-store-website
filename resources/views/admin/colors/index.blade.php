@extends('admin.layouts.app')
@section('title', 'trang sản phẩm produc')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Màu Sắc</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->color }}</td>
                <td>
                    <a href="{{ route('colors.edit', $item)  }}">
                        <button>sua</button>

                    </a>
                    <form action="{{ route('colors.destroy',$item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">xoa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection