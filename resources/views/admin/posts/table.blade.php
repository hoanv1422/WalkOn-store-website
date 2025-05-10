@foreach ($posts as $post)
    <tr>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checkAll" value="{{ $post->id }}">
            </div>
        </td>
        <td>{{ $post->title }}</td>
        <td>
            @if ($post->thumbnail)
                <img src="/uploads/posts/{{ $post->thumbnail }}" alt="{{ $post->title }}" style="width: 50px; height: 50px; object-fit: cover;">
            @else
                N/A
            @endif
        </td>
        <td>{{ $post->category ? $post->category->name : 'N/A' }}</td>
        <td>{{ $post->user ? $post->user->name : 'N/A' }}</td>
        <td>
            <span class="badge bg-{{ $post->status == 'published' ? 'success' : ($post->status == 'draft' ? 'warning' : 'danger') }}">
                {{ $post->status }}
            </span>
        </td>
        <td>
            <button class="btn btn-sm btn-info detail-item-btn"
                data-bs-toggle="modal" data-bs-target="#showModalDetail"
                data-title="{{ $post->title }}"
                data-categoryname="{{ $post->category ? $post->category->name : 'N/A' }}"
                data-user="{{ $post->user ? $post->user->name : 'N/A' }}"
                data-status="{{ $post->status }}"
                data-content="{{ $post->content }}"
                data-thumbnail="{{ $post->thumbnail }}"
                data-images="{{ json_encode($post->images->pluck('image_path')->toArray()) }}">
                <i class="ri-eye-line"></i>
            </button>
            <button class="btn btn-sm btn-primary edit-item-btn"
                data-bs-toggle="modal" data-bs-target="#showModalEdit"
                data-id="{{ $post->id }}"
                data-title="{{ $post->title }}"
                data-category="{{ $post->category_id }}"
                data-status="{{ $post->status }}"
                data-content="{{ $post->content }}"
                data-images="{{ json_encode($post->images->toArray()) }}">
                <i class="ri-pencil-line"></i>
            </button>
            <button class="btn btn-sm btn-danger remove-item-btn"
                data-bs-toggle="modal" data-bs-target="#deleteRecordModal"
                data-id="{{ $post->id }}">
                <i class="ri-delete-bin-line"></i>
            </button>
        </td>
    </tr>
@endforeach