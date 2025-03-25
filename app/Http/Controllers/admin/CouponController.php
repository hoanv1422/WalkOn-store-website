<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CouponBrand;
use App\Models\CouponCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categories = Category::query()->where("is_active", true)->get();
            $brands = Brand::query()->where("is_active", true)->get();
            $status = $request->get('status');

            $query = Coupon::query();

            if ($status === 'delivered') {
                $query->where('is_active', 1)->where('end_time', '>', now());
            } elseif ($status === 'pickups') {
                $query->where('is_active', 0);
            } elseif ($status === 'returns') {
                $query->where('end_time', '<', now());
            } elseif ($status === 'cancelled') {
                $query->where('is_active', 0)->where('end_time', '<', now());
            }

            $coupons = $query->get();
            return view("admin.coupons.index", compact("coupons", "categories", "brands"));
        } catch (\Exception $e) {
            return back()->with("error", "Lỗi không thể vào trang này");
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function create()
    {
        $categories = Category::query()->where("is_active", true)->get();
        $brands = Brand::query()->where("is_active", true)->get();
        return view("admin.coupons.create", compact("categories", "brands"));
    }


    public function store(StoreCouponRequest $request)
    {
        $data = $request->except(["category_id", "brand_id"]);
        $categories = json_decode($request->category_id, true);
        $brands = json_decode($request->brand_id, true);

        try {
            DB::beginTransaction();
            $coupon = Coupon::query()->create($data);

            foreach ($categories as $category_id) {
                CouponCategory::query()->create([
                    'coupon_id' => $coupon->id,
                    'category_id' => $category_id
                ]);
            }

            foreach ($brands as $brand_id) {
                CouponBrand::query()->create([
                    'coupon_id' => $coupon->id,
                    'brand_id' => $brand_id
                ]);
            }
            DB::commit();
            return redirect()-> route("coupons.index")->with("success", "Thêm thành công!");
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with("error", "Lỗi khi thêm");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon) {
        $categories = Category::query()->where("is_active", true)->get();
        $brands = Brand::query()->where("is_active", true)->get();

        $selectedCategoryIds = CouponCategory::where("coupon_id", $coupon->id)->pluck("category_id")->toArray();
        $selectedBrandIds = CouponBrand::where("coupon_id", $coupon->id)->pluck("brand_id")->toArray();

        return view("admin.coupons.show", compact("coupon", "categories", "brands", "selectedCategoryIds", "selectedBrandIds"));
    }

    public function edit(Coupon $coupon)
    {
        $categories = Category::query()->where("is_active", true)->get();
        $brands = Brand::query()->where("is_active", true)->get();

        $selectedCategoryIds = CouponCategory::where("coupon_id", $coupon->id)->pluck("category_id")->toArray();
        $selectedBrandIds = CouponBrand::where("coupon_id", $coupon->id)->pluck("brand_id")->toArray();

        return view("admin.coupons.edit", compact("coupon", "categories", "brands", "selectedCategoryIds", "selectedBrandIds"));
    }



    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $data = $request->except(["category_id", "brand_id"]);
        $categories = json_decode($request->category_id, true);
        $brands = json_decode($request->brand_id, true);



        try {
            DB::beginTransaction();

            $coupon->update($data);

            CouponCategory::where('coupon_id', $coupon->id)->delete(); 
            foreach ($categories as $category_id) {
                CouponCategory::query()->create([
                    'coupon_id' => $coupon->id,
                    'category_id' => $category_id
                ]);
            }

            CouponBrand::where('coupon_id', $coupon->id)->delete(); 
            foreach ($brands as $brand_id) {
                CouponBrand::query()->create([
                    'coupon_id' => $coupon->id,
                    'brand_id' => $brand_id
                ]);
            }

            DB::commit();
            return redirect()->route("coupons.index")->with("success", "Cập nhật thành công!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Lỗi khi cập nhật: " . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        try {
            DB::beginTransaction();

            CouponCategory::query()->where('coupon_id', $coupon->id)->delete();

            CouponBrand::query()->where('coupon_id', $coupon->id)->delete();

            $coupon->delete();

            DB::commit();

            return redirect()->route('coupons.index')
                ->with('success', 'Mã giảm giá "' . $coupon->code . '" đã được xóa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('coupons.index')
                ->with('error', 'Có lỗi xảy ra khi xóa mã giảm giá: ' . $e->getMessage());
        }
    }
}
