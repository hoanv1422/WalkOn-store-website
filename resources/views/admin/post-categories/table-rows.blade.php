@foreach ($postCategories as $item)
<tr>
    <th scope="row">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="chk_child">
        </div>
    </th>
    <td class="name">{{ $item->name }}</td>
    <td class="status">
        <span class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
            {{ $item->is_active ? 'Hoạt Động' : 'Ẩn' }}
        </span>
    </td>
    <td>
        <ul class="list-inline hstack gap-2 mb-0">
            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                <a href="#showModalEdit" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn"
                   data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-status="{{ $item->is_active }}">
                    <i class="ri-pencil-fill fs-16"></i>
                </a>
            </li>
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-id="{{ $item->id }}" href="#deleteRecordModal">
                    <i class="ri-delete-bin-5-fill fs-16"></i>
                </a>
            </li>
        </ul>
    </td>
</tr>
@endforeach
