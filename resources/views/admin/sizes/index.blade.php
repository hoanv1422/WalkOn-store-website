@extends('admin.layouts.app')
@section('title', 'trang sản phẩm produc')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kích cỡ</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->size }}</td>
                <td>
                    <a href="{{ route('sizes.edit', $item)  }}">
                        <button>sua</button>

                    </a>
                    <form action="{{ route('sizes.destroy',$item) }}" method="POST">
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