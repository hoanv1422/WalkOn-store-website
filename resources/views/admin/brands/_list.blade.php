<table id="categoryTable" class="table align-middle dataTable">
    <thead class="table-light text-muted">
        <tr>
            <th style="width: 15px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll">
                </div>
            </th>
            <th style="width: 200px;">Tên Thương Hiệu</th>
            <th style="width: 50px;">Logo</th>
            <th style="width: 500px;">Mô tả</th>
            <th style="width: 100px;">Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody class="list form-check-all">
        @foreach ($brands as $item)
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chk_child">
                    </div>
                </th>
                <td>{{ $item->name }}</td>
                <td>
                    <div class="avatar-sm bg-light rounded p-1 overflow-hidden">
                        <img src="{{ Storage::url($item->logo) }}" alt="" class="img-fluid d-block">
                    </div>
                </td>
                <td>{{ $item->description }}</td>
                <td>
                    <span class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                        {{ $item->is_active ? 'Hoạt Động' : 'Ẩn' }}
                    </span>
                </td>
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item edit" title="Edit">
                            <a href="#showModalEdit" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn"
                               data-id="{{ $item->id }}"
                               data-logo="{{ Storage::url($item->logo) }}"
                               data-name="{{ $item->name }}"
                               data-description="{{ $item->description }}"
                               data-status="{{ $item->is_active }}">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                        <li class="list-inline-item" title="Remove">
                            <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal"
                               data-id="{{ $item->id }}">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if(method_exists($brands, 'links'))
    <div class="mt-3">
        {{ $brands->appends(request()->query())->links() }}
    </div>
@endif
