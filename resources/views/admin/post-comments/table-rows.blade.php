@foreach ($postComments as $comment)
<tr>
    <th scope="row">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="chk_child">
        </div>
    </th>
    <td class="content">{{ Str::limit($comment->content, 100) }}</td>
    <td class="parent">
        @if ($comment->parent)
            {{ Str::limit($comment->parent->content, 50) }}
        @else
            N/A
        @endif
    </td>
    <td class="post">{{ $comment->post->title ?? 'N/A' }}</td>
    <td class="user">{{ $comment->user->name ?? 'N/A' }}</td>
    <td class="status">
        <span class="badge 
            @if ($comment->status == 'published') bg-success-subtle text-success
            @elseif($comment->status == 'pending') bg-warning-subtle text-warning
            @else bg-danger-subtle text-danger @endif">
            {{ ucfirst($comment->status) }}
        </span>
    </td>
    <td>
        <ul class="list-inline hstack gap-2 mb-0">
            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                <a href="#showModalEdit" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn"
                   data-id="{{ $comment->id }}"
                   data-content="{{ $comment->content }}"
                   data-status="{{ $comment->status }}">
                    <i class="ri-pencil-fill fs-16"></i>
                </a>
            </li>
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-id="{{ $comment->id }}" href="#deleteRecordModal">
                    <i class="ri-delete-bin-5-fill fs-16"></i>
                </a>
            </li>
        </ul>
    </td>
</tr>
@endforeach
