<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ColorController extends Controller 
{
    const PATH_VIEW = 'admin.colors.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Color::query()->latest('id')->with(['productVariant'])->paginate();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['color']);
        $existingColor = Color::where('code', $data['code'])->first();
        if ($existingColor) {
            return back()->with('error', 'Mã màu đã tồn tại.');
        }
        try {
            DB::beginTransaction();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view(self::PATH_VIEW.__FUNCTION__,compact('color'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['color']);
        $existingColor = Color::where('code', $data['code'])->where('id', '!=', $color->id)->first();
        if ($existingColor) {
            return back()->with('error', 'Mã màu đã tồn tại.');
        }

        try {
            DB::beginTransaction();

            $color->update($data);

            DB::Commit();
            return redirect()->route('attributes.index')->with('success', 'Sửa màu sắc thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            DB::beginTransaction();
            $color->delete();
            DB::commit();
            return redirect()->route('attributes.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }
}
