<?php

<<<<<<< HEAD
namespace App\Http\Controllers\admin;
=======
namespace App\Http\Controllers\Admin;
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f

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
<<<<<<< HEAD
        $data = Size::query()->latest('id')->with(['productVariant'])->paginate();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
=======
        $sizes = Size::all();
        $colors = Color::all();
        $sizeSlug = Size::select('id', 'slug')->get();
        $colorSlug = Color::select('id', 'slug')->get();
        return view('admin.attributes.index', compact('sizes', 'colors', 'sizeSlug', 'colorSlug'));
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
<<<<<<< HEAD
       $data=$request->all();
       Size::query()->create($data);
       return redirect()->route('sizes.index');
    }
=======
        $data = $request->all();
        $data['slug'] = Str::slug($data['size']);
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f

        try {
            DB::beginTransaction();

<<<<<<< HEAD
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view(self::PATH_VIEW.__FUNCTION__,compact('size'));
=======
            Size::query()->create($data);

            DB::Commit();
            return redirect()->route('attributes.index')->with('success', 'Thêm kích cỡ thành công');
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
    public function update(UpdateSizeRequest $request, Size $size)
    {
<<<<<<< HEAD
        $data=$request->all();
        $size->update($data);       
        return redirect()->route('sizes.index');
=======
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
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
<<<<<<< HEAD
        $size->delete();
        return redirect()->route('sizes.index');
=======
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
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
    }
}
