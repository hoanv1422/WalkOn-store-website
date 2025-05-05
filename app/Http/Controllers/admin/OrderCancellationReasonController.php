<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderCancellationReason;
use Illuminate\Http\Request;

class OrderCancellationReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reasons = OrderCancellationReason::all();
        return view('admin.order_cancellation.order_cancellation', compact('reasons'));
    }

    public function create()
    {
        return view('admin.order_cancellation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|unique:order_cancellation_reasons,reason',
        ]);

        OrderCancellationReason::create($request->only('reason'));

        return redirect()->route('reasons.index')->with('success', 'Đã thêm lý do hủy đơn');
    }

    public function edit($id)
    {
        $reason = OrderCancellationReason::findOrFail($id);
        return view('admin.order_cancellation.edit', compact('reason'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|unique:order_cancellation_reasons,reason,' . $id,
        ]);

        $reason = OrderCancellationReason::findOrFail($id);
        $reason->update($request->only('reason'));

        return redirect()->route('reasons.index')->with('success', 'Đã cập nhật lý do hủy đơn');
    }

    public function destroy($id)
    {
        $reason = OrderCancellationReason::findOrFail($id);
        $reason->delete();

        return redirect()->route('reasons.index')->with('success', 'Đã xóa lý do hủy đơn');
    }
}