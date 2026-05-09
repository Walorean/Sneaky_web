<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shoe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index_display(){
        $men_products = Product::with(['shoes.color', 'image'])
            ->whereHas('category', function($q) {
                $q->where('name', 'men');
            })
            ->take(4)
            ->get();

        $women_products = Product::with(['shoes.color', 'image'])
            ->whereHas('category', function($q) {
                $q->where('name', 'women');
            })
            ->take(4)
            ->get();

        return view('index', compact('men_products', 'women_products'));
    }
}
