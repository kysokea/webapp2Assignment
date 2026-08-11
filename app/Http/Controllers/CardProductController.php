<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CardProductController extends Controller
{
    // public function index()
    // {
    //     $productCards = Product::where('disable', 0)
    //         ->latest()
    //         ->paginate(12);

    //     return view('action.choosingproduct', compact('productCards'));
    // }
    // public function selectedProduct($id)
    // {
    //     $product = Product::with('category')->findOrFail($id);

    //     // Get products for the cards again
    //     $productCards2 = Product::where('disable', 0)
    //         ->latest()
    //         ->paginate(12);

    //     return view('action.choosingproduct', compact(
    //         'product',
    //         'productCards2'
    //     ));
    // }

    public function index()
    {
        $productCards = Product::where('disable', 0)
            ->latest()
            ->paginate(12);

        $cart = session()->get('cart', []);

        return view('action.choosingproduct', compact(
            'productCards',
            'cart'
        ));
    }


    public function selectedProduct($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id'       => $product->product_id,
                'name'     => $product->product_name_en,
                'price'    => $product->price,
                'avatar'   => $product->avatar ?? null,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('actions.index');
    }


    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->route('actions.index');
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $quantity = max(1, (int) $request->quantity);

            $cart[$id]['quantity'] = $quantity;

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'quantity' => $quantity,
        ]);
    }

}
