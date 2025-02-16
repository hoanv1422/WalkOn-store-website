<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'brands';

    public function index()
    {
        $brands = Brand::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {

        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::put(self::PATH_UPLOAD, $request->file('logo'));
        } else {
            $data['logo'] = '';
        }
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']);

        try {
            DB::beginTransaction();

            Brand::query()->create($data);

            DB::Commit();
            return redirect()->route('brands.index')->with('success', 'Thêm thương hiệu thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

            if (isset($data['logo'])) {
                Storage::delete($data['logo']);
            }
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm ');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        // dd($request->all());

        // Data user
        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::put(self::PATH_UPLOAD, $request->file('logo'));
            if (!empty($brand->logo) && Storage::exists($brand->logo)) {
                Storage::delete($brand->logo);
            }
        } else {
            $data['logo'] = $brand->logo;
        }
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']);


        try {
            DB::beginTransaction();
            // Update brand 
            $brand->update($data);

            DB::Commit();
            return redirect()->route('brands.index')->with('success', 'Cập nhật thương hiệu thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

            if (isset($data['logo'])) {
                Storage::delete($data['logo']);
            }

            dd($exception);
            return back()->with('error', 'Có lỗi khi cập nhật');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            DB::beginTransaction();


            $brand->delete();

            if ($brand->logo) {
                Storage::delete($brand->logo);
            }

            DB::commit();
            return redirect()->route('brands.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }
}
