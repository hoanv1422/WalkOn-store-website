<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CourierController extends Controller
{
    const PATH_VIEW = 'admin.couriers.';

    /**
     * Hiển thị danh sách Shipper 
     */
    public function index()
    {
        $couriers = Courier::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        $existentIds = Courier::pluck('user_id')->toArray();
        $users = User::where('role', 'shipper')
            ->where('is_active', true)
            ->whereNotIn('id', $existentIds)
            ->get();

        return view(self::PATH_VIEW . 'index', compact('couriers', 'users'));
    }

    /**
     * Hiển thị form sửa riêng
     */
    public function create()
    {
        // Khi tạo mới từ view riêng: cũng chỉ lấy user chưa có Courier
        $existentIds = Courier::pluck('user_id')->toArray();
        $users = User::where('role', 'shipper')
            ->where('is_active', true)
            ->whereNotIn('id', $existentIds)
            ->get();

        return view(self::PATH_VIEW . 'create', compact('users'));
    }

    /**
     * Lưu Shipper mới
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => [
                'required',
                Rule::exists('users', 'id')->where('role', 'shipper'),
            ],
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string|max:500',
            'vehicle_type'  => 'required|string|max:100',
            'license_plate' => 'nullable|string|max:50',
            'delivery_area' => 'required|string|max:255',
            'status'        => ['required', Rule::in(['active', 'inactive', 'suspended'])],
            
        ]);

        // Kiểm tra user chưa có Courier
        if (Courier::where('user_id', $data['user_id'])->exists()) {
            return back()->withInput()->with('error', 'Người dùng này đã có thông tin Shipper');
        }

        DB::transaction(function () use ($data) {
            Courier::create($data);
        });

        return redirect()->route('couriers.index')
            ->with('success', 'Thêm Shipper thành công');
    }

    public function show(Courier $courier)
    {
        return response()->json($courier);
    }
    /**
     * Hiển thị form sửa
     */
    public function edit(Courier $courier)
    {
        $users = User::where('role', 'shipper')
            ->where('is_active', true)
            ->get();
        return view(self::PATH_VIEW . 'edit', compact('courier', 'users'));
    }

    /**
     * Cập nhật Shipper
     */
    // app/Http/Controllers/Admin/CourierController.php

    public function update(Request $request, Courier $courier)
    {
        $data = $request->validate([
            'user_id'       => [
                'required',
                Rule::exists('users', 'id')->where('role', 'shipper'),
            ],
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string|max:500',
            'vehicle_type'  => 'required|string|max:100',
            'license_plate' => 'nullable|string|max:50',
            'delivery_area' => 'required|string|max:255',
            'status'        => ['required', Rule::in(['active', 'inactive', 'suspended'])],
        ]);

        // ---  chặn nếu user_id trùng ---
        // if ($courier->user_id !== $data['user_id'] && Courier::where('user_id', $data['user_id'])->exists()) {
        //     return back()->withInput()->with('error', 'Người dùng này đã có thông tin Shipper');
        // }

        DB::transaction(function () use ($courier, $data) {
            $courier->update($data);
        });

        return redirect()->route('couriers.index')
            ->with('success', 'Cập nhật Shipper thành công');
    }


    /**
     * Xóa Shipper
     */
    public function destroy(Courier $courier)
    {
        DB::transaction(function () use ($courier) {
            $courier->delete();
        });

        return redirect()->route('couriers.index')
            ->with('success', 'Xóa Shipper thành công');
    }

    /**
     * Lọc Shipper
     */
    public function filter(Request $request)
    {
        $request->validate([
            'keyword'    => 'nullable|string|max:255',
            'date_range' => 'nullable|string',
            'status'     => ['nullable', Rule::in(['all', 'active', 'inactive', 'suspended'])],
        ]);

        $query = Courier::query();

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'LIKE', "%{$kw}%")
                    ->orWhere('phone', 'LIKE', "%{$kw}%")
                    ->orWhere('license_plate', 'LIKE', "%{$kw}%");
            });
        }

        if ($request->filled('date_range')) {
            $parts = explode(' - ', $request->date_range);
            if (count($parts) === 2) {
                try {
                    $start = Carbon::createFromFormat('d/m/Y', trim($parts[0]))->startOfDay();
                    $end   = Carbon::createFromFormat('d/m/Y', trim($parts[1]))->endOfDay();
                    $query->whereBetween('created_at', [$start, $end]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Định dạng ngày không hợp lệ!');
                }
            }
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $couriers = $query->orderBy('created_at', 'desc')->get();
        $title    = 'Kết quả lọc Shipper';
        $existentIds = Courier::pluck('user_id')->toArray();
        $users = User::where('role', 'shipper')
            ->where('is_active', true)
            ->whereNotIn('id', $existentIds)
            ->get();

        return view(self::PATH_VIEW . 'index', compact('couriers', 'users', 'title'));
    }
}
