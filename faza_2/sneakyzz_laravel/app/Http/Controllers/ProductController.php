<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($product_code, $color_id = null)
    {
        $product = Product::with(['shoes.color', 'shoes.size', 'image'])
            ->where('product_code', $product_code)
            ->firstOrFail();

        $colors = $product->shoes->pluck('color')->unique('color_id');

        $selectedColor = $color_id ?? $colors->first()->color_id;

        $sizes = $product->shoes
            ->where('color_id', $selectedColor)
            ->where('stock_quantity', '>', 0);

        $totalStock = $product->shoes
            ->where('color_id', $selectedColor)
            ->sum('stock_quantity');

        $related_products = Product::whereHas('category', function($q) use ($product) {
            $q->whereIn('name', $product->category->pluck('name'));
        })
            ->where('product_code', '!=', $product_code)
            ->take(6)
            ->get();

        $selectedShoe = $product->shoes
            ->where('color_id', $selectedColor)
            ->first();

        return view('product', compact('product', 'colors', 'sizes', 'selectedColor', 'related_products', 'selectedShoe', 'totalStock'));
    }

    public function category($name, Request $request){
        $query = Product::with('image')
            ->whereHas('category', function($q) use ($name) {
                $q->where('name', $name);
            });

        if($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if($request->filled('min_size') || $request->filled('max_size')) {
            $query->whereHas('shoes.size', function($q) use ($request) {
                if($request->filled('min_size')) {
                    $q->where('size', '>=', $request->min_size);
                }
                if($request->filled('max_size')) {
                    $q->where('size', '<=', $request->max_size);
                }
            });
        }

        if($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if($request->filled('sort')) {
            if($request->sort === 'price-asc') {
                $query->orderBy('price', 'asc');
            } elseif($request->sort === 'price-desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(12);
        $brands = Brand::all();

        return view('category', compact('products', 'name', 'brands'));
    }

    public function search(Request $request)
    {
        $query_string = $request->input('query');

        if(empty($query_string)) {
            return redirect()->route('home');
        }

        $query = Product::with('image')
            ->where(function($q) use ($query_string) {
                $q->where('name', 'LIKE', '%' . $query_string . '%')
                    ->orWhere('product_code', 'LIKE', '%' . $query_string . '%')
                    ->orWhere('basic_info', 'LIKE', '%' . $query_string . '%')
                    ->orWhere('origin', 'LIKE', '%' . $query_string . '%');
            });

        if($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if($request->filled('sort')) {
            if($request->sort === 'price-asc') {
                $query->orderBy('price', 'asc');
            } elseif($request->sort === 'price-desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(12);
        $name = 'Results for "' . $query_string . '"';
        $brands = Brand::all();

        return view('category', compact('products', 'name', 'brands'));
    }
}
