<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    const PATH_VIEW = 'admin.sizes.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $sizeSlug = Size::select('id', 'slug')->get();
        $colorSlug = Color::select('id', 'slug')->get();
        return view('admin.attributes.index', compact('sizes', 'colors', 'sizeSlug', 'colorSlug'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['size']);

        try {
            DB::beginTransaction();

            Size::query()->create($data);

            DB::Commit();
            return redirect()->route('attributes.index')->with('success', 'Thêm kích cỡ thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['size']);

        try {
            DB::beginTransaction();

            $size->update($data);

            DB::Commit();
            return redirect()->route('attributes.index')->with('success', 'Sửa kích cỡ thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            DB::beginTransaction();
            $size->delete();
            DB::commit();
            return redirect()->route('attributes.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }
}
