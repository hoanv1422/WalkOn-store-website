<?php

<<<<<<< HEAD
namespace App\Http\Controllers\admin;
=======
namespace App\Http\Controllers\Admin;
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f

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
<<<<<<< HEAD
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
=======
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $data = $request->all();
<<<<<<< HEAD
        Color::query()->create($data);
        return redirect()->route('colors.index');

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
=======
        $data['slug'] = Str::slug($data['color']);

        try {
            DB::beginTransaction();

            Color::query()->create($data);

            DB::Commit();
            return redirect()->route('attributes.index')->with('success', 'Thêm màu sắc thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm');
        }
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
<<<<<<< HEAD
        $data=$request->all();
        $color->update($data);
        return redirect()->route('colors.index');
=======
        $data = $request->all();
        $data['slug'] = Str::slug($data['color']);

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
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
<<<<<<< HEAD
        $color->delete();
        return redirect()->route('colors.index')->with('success','xoa thanh cong');
=======
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
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }
}
