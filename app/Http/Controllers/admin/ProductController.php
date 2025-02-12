<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';


    public function index()
    {
        // Giả sử bạn có model Product, lấy tất cả sản phẩm
        $products = Product::all();
        $products_active = Product::query()->where('is_active', true)->get();
        $products_non_active = Product::query()->where('is_active', false)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('products', 'products_active', 'products_non_active'));
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


        // dd($request->all());

        // Data Product
        $data = $request->except(['product_variant', 'product_galleries', 'image']);
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        } else {
            $data['image'] = '';
        }
        $data['sku'] = 'WO' . $data['brand_id'] . $data['category_id'] . '-' . now()->format('His');
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']) . '-' . $data['sku'];


        // Data Biến thể
        $listProVariants = $request->product_variant  ?: [];
        $dataProVariants = [];
        $totalQuantity = 0;
        foreach ($listProVariants as $item) {
            $dataProVariants[] = [
                'size_id' => $item['color'],
                'color_id' => $item['size'],
                'image' => !empty($item['image']) ? Storage::put('product_variant', $item['image']) : null,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
            $totalQuantity += $item['quantity'];
        }

        $data['quantity'] = $totalQuantity;


        // Data Thư viện ảnh
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
            // Insert Product 
            $product = Product::query()->create($data);

            // Insert ProductVariant
            foreach ($dataProVariants as $item) {
                $item += ['product_id' => $product->id];
                ProductVariant::query()->create($item);
            }

            // Insert ProductGallery
            foreach ($dataProGalleries as $item) {
                $item += ['product_id' => $product->id];
                ProductGallery::query()->create($item);
            }

            DB::Commit();
            return back()->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

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
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        
        return view(self::PATH_VIEW . __FUNCTION__, compact('product')); 
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
        
        // Data Product
        $data = $request->except(['product_variant', 'product_galleries', 'image']);
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if (!empty($product->image) && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
        } else {
            $data['image'] = $product->image;
        }
        // $data['sku'] = 'WO' . $data['brand_id'] . $data['category_id'] . '-' . $product->created_at->format('His');
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']) . '-' . $product->sku;


        // Data Biến thể
        $listProVariants = $request->product_variant  ?: [];
        $dataProVariants = [];
        $totalQuantity = 0;
        foreach ($listProVariants as $item) {
            $dataProVariants[] = [
                'id' => $item['id'],
                'size_id' => $item['size'],
                'color_id' => $item['color'] ,
                'image' => !empty($item['image']) ? Storage::put('product_variant', $item['image']) : null,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
            $totalQuantity += $item['quantity'];
        }

        $data['quantity'] = $totalQuantity;

        // Data Thư viện ảnh
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
            // Update Product 
            $product->update($data);

            // Insert ProductVariant
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
                            $item['image'] = Storage::put('product_variant', $item['image']);
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
            return redirect()->route('products.edit', $product)->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

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
            // $product->hinhAnhproduct()->delete();

            // DELETE ORDER

            // $product->productVariants()->delete();

            $product->delete();

            // $products = product::orderBy('id')->get();

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
