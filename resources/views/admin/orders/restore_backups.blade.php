@extends('admin.layouts.app')
@section('title', 'Khôi phục Backup Đơn Hàng')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-light d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Quản lý Backup & Khôi phục Đơn Hàng</h5>
            </div>

            <div class="card-body">
                <!-- Card: Bộ lọc backup -->
                <div class="card mb-4 border shadow-none">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Tìm kiếm bản backup</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.backups') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label for="order_code" class="form-label fw-semibold">Mã đơn hàng (nếu cần)</label>
                                <input type="text" name="order_code" id="order_code" class="form-control"
                                    placeholder="VD: ORD20250321..." />
                            </div>
                            <div class="col-md-3">
                                <label for="start_date" class="form-label fw-semibold">Từ ngày</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label fw-semibold">Đến ngày</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" />
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ri-search-line align-middle me-1"></i> Tìm kiếm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Card: Bộ lọc backup -->

                <!-- Card: Khôi phục toàn bộ theo ngày -->
                <div class="card mb-4 border shadow-none">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Khôi phục toàn bộ theo ngày</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.restoreBackupsByDate') }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <label for="restore_date" class="form-label fw-semibold">Chọn ngày</label>
                                <input type="date" name="date" id="restore_date" class="form-control" />
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="ri-history-line align-middle me-1"></i> Khôi phục toàn bộ
                                </button>
                            </div>
                            <div class="col-md-5 d-flex align-items-end">
                                <small class="text-muted">
                                    <em>Lưu ý:</em> Hành động này sẽ khôi phục <strong>tất cả</strong> đơn hàng
                                    có bản backup được tạo vào ngày bạn chọn.
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Card: Khôi phục toàn bộ theo ngày -->

                <!-- Danh sách backup sau khi lọc -->
                <div class="card border shadow-none">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Kết quả tìm kiếm bản backup</h6>
                    </div>
                    <div class="card-body">
                        @if ($backups->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 60px;">ID</th>
                                            <th style="min-width: 200px;">Mã đơn hàng</th>
                                            <th style="min-width: 160px;">Người cập nhật</th>
                                            <th style="min-width: 180px;">Lý do backup</th>
                                            <th style="min-width: 180px;">Thời gian backup</th>
                                            <th class="text-center" style="width: 120px;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($backups as $backup)
                                            <tr>
                                                <td>{{ $backup->id }}</td>
                                                <td>
                                                    @php
                                                        $order = \App\Models\Order::find($backup->original_order_id);
                                                    @endphp
                                                    {{ $order->order_code ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{-- Lấy tên user đã thực hiện backup (nếu có liên kết user_id -> user) --}}
                                                    @php
                                                        $backupUser = $backup->user; // Đảm bảo trong model OrderBackup có user()
                                                    @endphp
                                                    {{ $backupUser->name ?? 'Hệ thống' }}
                                                </td>
                                                <td>{{ $backup->reason }}</td>
                                                <td>
                                                    {{ $backup->created_at->format('d/m/Y - H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('orders.restoreBackup', $backup->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục backup này?');">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- 
                                                      Tuỳ chọn: Thêm checkbox nếu muốn xóa luôn bản backup sau khi restore
                                                      <div class="form-check form-check-inline">
                                                          <input class="form-check-input" type="checkbox" 
                                                                 name="delete_after_restore" id="delete_after_restore" value="1">
                                                          <label class="form-check-label" for="delete_after_restore">
                                                              Xoá backup sau khi restore
                                                          </label>
                                                      </div>
                                                    --}}

                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            <i class="ri-history-line align-middle"></i> Khôi phục
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mb-0" role="alert">
                                Không tìm thấy bản backup nào theo tiêu chí đã chọn.
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End Danh sách backup -->
            </div>
        </div>
    </div>
@endsection
