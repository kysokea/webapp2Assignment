<?php

namespace App\Http\Controllers;

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
}
