<table class="table align-middle dataTable">
    <thead class="table-light text-muted">
        <tr>
            <th scope="col" style="width: 15px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll">
                </div>
            </th>
            <th class="sort" data-sort="name">Tên Thuộc Tính</th>
            <th class="sort" data-sort="action">Hành Động</th>
        </tr>
    </thead>
    <tbody class="list form-check-all">
        @foreach ($sizes as $item)
            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chk_child">
                    </div>
                </th>
                <td class="name">{{ $item->size }}</td>
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item edit" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Edit">
                            <a href="#showModalEditSize" data-bs-toggle="modal"
                               class="text-primary d-inline-block edit-item-btn"
                               data-id="{{ $item->id }}" data-type="size"
                               data-size="{{ $item->size }}">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                        <li class="list-inline-item" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Remove">
                            <a class="text-danger d-inline-block remove-item-btn"
                               data-bs-toggle="modal" href="#deleteRecordModalSize"
                               data-id="{{ $item->id }}" data-type="size">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
