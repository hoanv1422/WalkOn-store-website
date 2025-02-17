<form action="{{ route('test') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="" value="{{ old('name') }}">
    <input type="file" name="image" id="fileInput" />
    @if ($errors->has('image'))
        <div class="text-danger">{{ $errors->first('image') }}</div>
    @endif

    <!-- Giữ lại thông tin file đã chọn -->
    @if(session('image'))
        <div>File đã chọn: {{ session('image') }}</div>
    @endif

    <button type="submit">Submit</button>
</form>
