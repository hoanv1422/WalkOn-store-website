<table id="colorTable" class="table align-middle table-hover">
    <thead class="table-light text-muted">
        <tr>
            <th scope="col" style="width: 40px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll">
                </div>
            </th>
            <th scope="col">Tên Màu</th>
            <th scope="col">Mã Màu</th>
            
            <th scope="col">Hành Động</th>
        </tr>
    </thead>
    <tbody class="list form-check-all">
        @foreach ($colors as $item)
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chk_child" value="{{ $item->id }}">
                    </div>
                </td>
                <td class="name">{{ $item->color }}</td>
                <td class="code">
                    <span class="badge" style="background-color: {{ $item->code }};">{{ $item->code }}</span>
                </td>
                
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item edit" data-bs-toggle="tooltip" title="Chỉnh sửa">
                            <a href="#showModalEditColor" data-bs-toggle="modal"
                               class="text-primary edit-item-btn"
                               data-id="{{ $item->id }}"
                               data-type="color"
                               data-color="{{ $item->color }}"
                               data-code="{{ $item->code }}">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                        <li class="list-inline-item delete" data-bs-toggle="tooltip" title="Xoá">
                            <a href="#deleteRecordModalColor" data-bs-toggle="modal"
                               class="text-danger remove-item-btn"
                               data-id="{{ $item->id }}"
                               data-type="color">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
