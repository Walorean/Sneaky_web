<?php

namespace App\Http\Controllers;

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
}
