<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shoe;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_panel');
    }

    public function createProduct()
    {
        $variantsCount = 1;
        $brands = Brand::all();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.admin_create_products' , compact('brands', 'categories', 'variantsCount', 'colors', 'sizes'));
    }

    public function showProducts(){
        $products = Product::with(['image', 'shoes'])->get();
        return view('admin.admin_stock', compact('products'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'product_code'                     => 'required|string|max:10|unique:products,product_code',
            'name'                             => 'required|string|max:100',
            'brand'                            => 'required',
            'price'                            => 'required|numeric|min:0',
            'categories'                       => 'required|array|min:1',
            'variants'                         => 'required|array|min:1',
            'variants.*.color_id'              => 'required',
            'variants.*.size_id'               => 'required',
            'variants.*.stock_quantity'        => 'required|integer|min:1',
            'variants.*.images'                => 'required|array|min:2',
            'variants.*.images.*'              => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::create([
            'product_code' => $request->product_code,
            'brand'        => $request->brand,
            'name'         => $request->name,
            'material'     => $request->material,
            'basic_info'   => $request->basic_info,
            'origin'       => $request->origin,
            'price'        => $request->price,
        ]);

        if ($request->has('categories')) {
            $product->category()->attach($request->categories);
        }

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $shoe = Shoe::create([
                    'product_code'   => $request->product_code,
                    'color_id'       => $variant['color_id'],
                    'size_id'        => $variant['size_id'],
                    'stock_quantity' => $variant['stock_quantity'],
                ]);

                if (isset($variant['images'])) {
                    foreach ($variant['images'] as $image) {
                        $path = $image->store('shoes', 'public');
                        Image::create([
                            'product_code' => $request->product_code,
                            'color_id'     => $variant['color_id'],
                            'filename'     => $path,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Product created successfully');
    }
}
