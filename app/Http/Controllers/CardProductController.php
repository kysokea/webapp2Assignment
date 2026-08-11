<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CardProductController extends Controller
{
    public function index()
    {
        $productCards = Product::where('disable', 0)
            ->latest()
            ->paginate(12);

        return view('action.choosingproduct', compact('productCards'));
    }
    public function selectedProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Get products for the cards again
        $productCards = Product::where('disable', 0)
            ->latest()
            ->paginate(12);

        return view('action.choosingproduct', compact(
            'product',
            'productCards'
        ));
    }
    // public function getCard($id){
    //     select product vai id
    // }
}
