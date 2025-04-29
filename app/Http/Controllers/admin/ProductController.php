<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';


    public function index()
    {
        $allProducts = Product::with('category')->get();
        $products_active = Product::where('is_active', true)->get();
        $products_non_active = Product::where('is_active', false)->get();
        $categories = Category::withCount('products')->where('is_active', true)->get();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.index', compact(
            'allProducts',
            'products_active',
            'products_non_active',
            'categories',
            'brands',
            'colors',
            'sizes'

        ));
    }

    public function filter(Request $request)
    {
        $query = Product::with(['category', 'brand']);
        // Lọc theo màu sắc
        if ($request->colors) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('color_id', $request->colors);
            });
        }
        
        // Lọc theo kích thước
        if ($request->sizes) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('size_id', $request->sizes);
            });
        }

        // Lọc theo danh mục
        if ($request->categories) {
            $query->whereIn('category_id', $request->categories);
        }

        // Lọc theo giá
        $query->whereBetween('price', [
            $request->minPrice ?? 0,
            $request->maxPrice ?? 100000000
        ]);
        
        // Lọc theo thương hiệu
        if ($request->brands) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Tìm kiếm sản phẩm
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Tìm kiếm thương hiệu
        if ($request->searchBrands) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->searchBrands . '%');
            });
        }

        // Lọc theo đánh giá
        if ($request->ratings) {
            $query->where(function ($q) use ($request) {
                foreach ($request->ratings as $rating) {
                    if (str_contains($rating, 'Above')) {
                        $minRating = (float)explode(' ', $rating)[0];
                        $q->orWhere('average_rating', '>=', $minRating);
                    } elseif ($rating === 'Below 1 Star') {
                        $q->orWhere('average_rating', '<', 1);
                    }
                }
            });
        }

        // Lọc theo giảm giá
        if ($request->discounts) {
            $query->where(function ($q) use ($request) {
                foreach ($request->discounts as $discount) {
                    if (str_contains($discount, 'Less than')) {
                        $q->orWhereRaw('
                                CASE 
                                    WHEN price > 0 THEN ROUND(((price - COALESCE(price_sale, price)) / price * 100)
                                    ELSE 0 
                                END < 10
                            ');
                    } else {
                        preg_match('/(\d+)%/', $discount, $matches);
                        $minDiscount = (int)($matches[1] ?? 0);
                        $q->orWhereRaw('
                                CASE 
                                    WHEN price > 0 THEN ROUND(((price - COALESCE(price_sale, price)) / price * 100)
                                    ELSE 0 
                                END >= ?
                            ', [$minDiscount]);
                    }
                }
            });
        }

        $baseQuery = clone $query;

        return response()->json([
            'html' => view('admin.products.product_lists', [
                'all' => $query->get(),
                'active' => (clone $baseQuery)->where('is_active', true)->get(),
                'nonActive' => (clone $baseQuery)->where('is_active', false)->get()
            ])->render(),
            'counts' => [
                'all' => $query->count(),
                'active' => (clone $baseQuery)->where('is_active', true)->count(),
                'nonActive' => (clone $baseQuery)->where('is_active', false)->count()
            ]
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::query()->where('is_active', true)->get();
        $categories = Category::query()->where('is_active', true)->get();
        $colors = Color::query()->pluck('color', 'id')->all();
        $sizes = Size::query()->pluck('size', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands', 'categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Data Product
        // dd($request->all());
        $data = $request->except(['product_variant', 'product_galleries', 'image']);


        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        } else {
            $data['image'] = $request->old('image');;
        }

        $data['sku'] = 'WO' . $data['brand_id'] . $data['category_id'] . '-' . now()->format('His');
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']) . '-' . $data['sku'];

        $listProVariants = $request->product_variant ?: [];
        $dataProVariants = [];
        $totalQuantity = 0;
        $variantMap = [];

        foreach ($listProVariants as $item) {
            $key = $item['size'] . '-' . $item['color'];

            if (isset($variantMap[$key])) {
                $dataProVariants[$variantMap[$key]]['quantity'] += $item['quantity'];
            } else {
                $dataProVariants[] = [
                    'size_id' => $item['size'],
                    'color_id' => $item['color'],
                    'image' => !empty($item['image']) ? Storage::put('product_variant', $item['image']) : null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'price_sale' => $item['price_sale']
                ];
                $variantMap[$key] = array_key_last($dataProVariants);
            }

            $totalQuantity += $item['quantity'];
        }

        $data['quantity'] = $totalQuantity;

        $listProGalleries = $request->product_galleries ?: [];
        $dataProGalleries = [];

        foreach ($listProGalleries as $item) {
            if (!empty($item)) {
                $dataProGalleries[] = [
                    'image' => Storage::put('product_galleries', $item)
                ];
            }
        }

        try {
            DB::beginTransaction();

            $product = Product::query()->create($data);

            foreach ($dataProVariants as &$item) {
                $item['product_id'] = $product->id;
                ProductVariant::query()->create($item);
            }

            foreach ($dataProGalleries as &$item) {
                $item['product_id'] = $product->id;
                ProductGallery::query()->create($item);
            }

            DB::commit();
            return back()->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();

            if (!empty($data['image'])) {
                Storage::delete($data['image']);
            }
            foreach ($dataProVariants as $item) {
                if (!empty($item['image'])) {
                    Storage::delete($item['image']);
                }
            }
            foreach ($dataProGalleries as $item) {
                if (!empty($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            dd($exception);

            return back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm')->withErrors($exception->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)

    {
        $sizes = $product->variants()
            ->select('size_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->groupBy('size_id')
            ->with('size')
            ->get();

        $colors = $product->variants()
            ->select('color_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->groupBy('color_id')
            ->with('color')
            ->get();


        $comments = $product->comments()->get();

        // dd($comments);

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'sizes', 'colors', 'comments'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $brands = Brand::query()->where('is_active', true)->get();
        $categories = Category::query()->where('is_active', true)->get();
        $colors = Color::query()->pluck('color', 'id')->all();
        $sizes = Size::query()->pluck('size', 'id')->all();
        $product_galleries = ProductGallery::query()->where('product_id', $product->id)->get();
        $product_variants = ProductVariant::query()->where('product_id', $product->id)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'brands', 'categories', 'colors', 'sizes', 'product_galleries', 'product_variants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->all());
        $data = $request->except(['product_variant', 'product_galleries', 'image']);
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if (!empty($product->image) && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
        } else {
            $data['image'] = $product->image;
        }
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']) . '-' . $product->sku;
        $data['quantity'] = 1;

        $listProVariants = $request->product_variant ?: [];
        $dataProVariants = [];
        $totalQuantity = 0;
        $groupedVariants = [];

        foreach ($listProVariants as $item) {
            $key = $item['size'] . '-' . $item['color'];

            if (!isset($groupedVariants[$key])) {
                $groupedVariants[$key] = [
                    'id' => $item['id'] ?? null,
                    'size_id' => $item['size'],
                    'color_id' => $item['color'],
                    'image' => !empty($item['image']) ? Storage::put('product_variant', $item['image']) : null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'price_sale' => $item['price_sale']

                ];
            } else {
                $groupedVariants[$key]['quantity'] += $item['quantity'];
            }

            $totalQuantity += $item['quantity'];
        }

        $dataProVariants = array_values($groupedVariants);
        $data['quantity'] = $totalQuantity;


        $listProGalleries = $request->product_galleries ?: [];
        $dataProGalleries = [];
        foreach ($listProGalleries as $item) {
            if (!empty('image')) {
                $dataProGalleries[] = [
                    'image' => Storage::put('product_galleries', $item)
                ];
            }
        }

        try {
            DB::beginTransaction();
            $product->update($data);

            $deletedVariants = json_decode($request->input('deleted_variants'), true);
            if (!empty($deletedVariants)) {
                foreach ($deletedVariants as $id) {
                    $variant = ProductVariant::find($id);
                    if ($variant) {

                        if (!empty($variant->image) && Storage::exists($variant->image)) {
                            Storage::delete($variant->image);
                        }
                        $variant->delete();
                    }
                }
            }
            foreach ($dataProVariants as $item) {
                if (!empty($item['id'])) {
                    $variant = ProductVariant::find($item['id']);
                    if ($variant) {
                        if (!empty($item['image'])) {
                            if (!empty($variant->image)) {
                                Storage::delete($variant->image);
                            }
                        } else {
                            $item['image'] = $variant->image;
                        }

                        $variant->update($item);
                    }
                } else {
                    $item['product_id'] = $product->id;
                    $item['image'] = !empty($item['image']) ? Storage::put('product_variant', $item['image']) : null;
                    ProductVariant::create($item);
                }
            }


            // Insert ProductGallery
            $deletedImages = json_decode($request->input('deleted_images'), true);
            if (!empty($deletedImages)) {
                foreach ($deletedImages as $id) {
                    $image = ProductGallery::find($id);
                    if ($image) {
                        Storage::delete($image->image);
                        $image->delete();
                    }
                }
            }
            foreach ($dataProGalleries as $item) {
                if (!isset($item['id'])) {
                    $item['product_id'] = $product->id;
                    ProductGallery::create($item);
                }
            }

            DB::Commit();
            return redirect()->route('products.index', $product)->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();

            if (isset($data['image'])) {
                Storage::delete($data['image']);
            }
            foreach ($dataProVariants as $item) {
                if (isset($item['image'])) {
                    Storage::delete($item['image']);
                }
            }
            foreach ($dataProGalleries as $item) {
                if (isset($item['image'])) {
                    Storage::delete($item['image']);
                }
            }
            dd($exception);
            return back()->with('error', 'Có lỗi khi cập nhật');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->galleries()->delete();

            // DELETE ORDER

            $product->variants()->delete();

            $product->delete();

            // DELETE IMAGE in Storage
            if ($product->image) {
                Storage::delete($product->image);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
        return back()->with('success', 'Xóa thành công');
    }
}
