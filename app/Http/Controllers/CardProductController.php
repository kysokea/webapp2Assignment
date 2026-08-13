<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, (int) $request->input('quantity'));
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
    // SaleController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'          => 'nullable|integer|exists:customers,customer_id',
            'payment_method'       => 'required|in:cash,card,qr',
            'discount'             => 'nullable|numeric|min:0',
            'exchange_rate'        => 'required|numeric|min:0',
            'sub_total_dollar'     => 'required|numeric|min:0',   // <-- likely missing
            'grand_total_dollar'   => 'required|numeric|min:0',   // <-- likely missing
            'sub_total_riel'       => 'required|numeric|min:0',   // <-- likely missing
            'grand_total_riel'     => 'required|numeric|min:0',   // <-- likely missing
            'cash_receive'         => 'nullable|numeric|min:0',
            'cash_return'          => 'nullable|numeric|min:0',
            'items'                => 'required|array|min:1',
            'items.*.product_id'   => 'required|integer|exists:products,product_id',
            'items.*.qty'          => 'required|integer|min:1',
            'items.*.price'        => 'required|numeric|min:0',
        ]);

        // Server-side guard — never trust the client
        if (
            $validated['payment_method'] === 'cash'
            && (float) ($validated['cash_receive'] ?? 0) < (float) $validated['grand_total_dollar']
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Cash received is not enough to cover the total.',
            ], 422);
        }

        // try {
            $sale = DB::transaction(function () use ($validated, $request) {

                $sale = Sale::create([
                    'customer_id'       => $validated['customer_id'] ?? null,
                    'user_id'           => auth()->id(),
                    'sale_date'         => now(),
                    'discount'          => $validated['discount'] ?? 0,
                    'sub_total_dollar'  => $validated['sub_total_dollar'],
                    'grand_total_dollar' => $validated['grand_total_dollar'],
                    'sub_total_riel'    => $validated['sub_total_riel'],
                    'grand_total_riel'  => $validated['grand_total_riel'],
                    'cash_receive'      => $validated['cash_receive'] ?? 0,
                    'cash_return'       => $validated['cash_return'] ?? 0,
                    'exchange_rate'     => $validated['exchange_rate'],
                ]);

                foreach ($validated['items'] as $item) {
                    SaleDetail::create([
                        'sale_id'    => $sale->sale_id,
                        'product_id' => $item['product_id'],
                        'qty'        => $item['qty'],
                        'price'      => $item['price'],
                    ]);
                }

                Payment::create([
                    'sale_id'        => $sale->sale_id,
                    'payment_method' => $validated['payment_method'],
                ]);

                session()->forget('cart'); // clear cart after successful sale

                return $sale;
            });

            return response()->json([
                'success'  => true,
                'redirect' => route('action.index'), // or wherever
            ]);
        // } catch (\Throwable $e) {
        //     report($e);
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to save sale to the database.',
        //     ], 500);
        // }
    }

}
