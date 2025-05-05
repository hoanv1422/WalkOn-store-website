{{-- resources/views/admin/couriers/_form.blade.php --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="user_id" class="form-label">Người dùng (Shipper)</label>
        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
            <option value="">-- Chọn người dùng --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->username }})
                </option>
            @endforeach
        </select>
        @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Tên Shipper</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone') }}">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="vehicle_type" class="form-label">Loại phương tiện</label>
        <select name="vehicle_type" id="vehicle_type" class="form-control @error('vehicle_type') is-invalid @enderror">
            <option value="">-- Chọn loại phương tiện --</option>
            <option value="Ô tô" {{ old('vehicle_type') == 'Ô tô' ? 'selected' : '' }}>Ô tô</option>
            <option value="Xe máy" {{ old('vehicle_type') == 'Xe máy' ? 'selected' : '' }}>Xe máy</option>
        </select>
        @error('vehicle_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="license_plate" class="form-label">Biển số xe</label>
        <input type="text" name="license_plate" id="license_plate"
            class="form-control @error('license_plate') is-invalid @enderror" value="{{ old('license_plate') }}">
        @error('license_plate')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="delivery_area" class="form-label">Khu vực giao hàng</label>
        <input type="text" name="delivery_area" id="delivery_area"
            class="form-control @error('delivery_area') is-invalid @enderror" value="{{ old('delivery_area') }}">
        @error('delivery_area')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Trạng thái</label>
        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror ">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            <option value="suspended"{{ old('status') == 'suspended' ? 'selected' : '' }}>Tạm dừng</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>
