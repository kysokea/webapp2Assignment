<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardProductController extends Controller
{

    public function index()
    {
        $productCards = Product::where('disable', 0)
            ->latest()
            ->paginate(12);
        $customers = Customer::all();
        $payments = Payment::all();

        $cart = session()->get('cart', []);

        return view('action.choosingproduct', compact(
            'productCards',
            'cart',
            'customers',
            'payments'
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
    public function sale(Request $request)
    {
        $validated = $request->validate([

            // Customer can be null for Walk-in Customer
            'customer_id' =>
            'nullable|integer|exists:customers,customer_id',

            // Payment method
            'payment_id' =>
            'required|integer|exists:payments,payment_id',

            'discount' =>
            'nullable|numeric|min:0',

            'exchange_rate' =>
            'required|numeric|min:0',

            'sub_total_dollar' =>
            'required|numeric|min:0',

            'grand_total_dollar' =>
            'required|numeric|min:0',

            'sub_total_riel' =>
            'required|numeric|min:0',

            'grand_total_riel' =>
            'required|numeric|min:0',

            'cash_receive' =>
            'nullable|numeric|min:0',

            'cash_return' =>
            'nullable|numeric|min:0',

            // Cart items
            'items' =>
            'required|array|min:1',

            'items.*.product_id' =>
            'required|integer|exists:products,product_id',

            'items.*.qty' =>
            'required|integer|min:1',

            'items.*.price' =>
            'required|numeric|min:0',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Get payment method
    |--------------------------------------------------------------------------
    */

        $payment = Payment::findOrFail(
            $validated['payment_id']
        );

        $paymentMethod =
            strtolower(
                $payment->payment_method_en ?? ''
            );


        /*
    |--------------------------------------------------------------------------
    | Cash validation
    |--------------------------------------------------------------------------
    */

        if ($paymentMethod === 'cash') {

            $cashReceive =
                (float) ($validated['cash_receive'] ?? 0);

            $grandTotal =
                (float) $validated['grand_total_dollar'];

            if ($cashReceive < $grandTotal) {

                return response()->json([
                    'success' => false,
                    'message' =>
                    'Cash received is not enough to cover the total.',
                ], 422);
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Save Sale
    |--------------------------------------------------------------------------
    */

        try {

            $sale = DB::transaction(function () use ($validated) {

                /*
            |--------------------------------------------------------------------------
            | Create Sale
            |--------------------------------------------------------------------------
            */

                $sale = Sale::create([

                    'customer_id' =>
                    $validated['customer_id'] ?? null,

                    'user_id' =>
                    auth()->id(),

                    'payment_id' =>
                    $validated['payment_id'],

                    'sale_date' =>
                    now(),

                    'discount' =>
                    $validated['discount'] ?? 0,

                    'sub_total_dollar' =>
                    $validated['sub_total_dollar'],

                    'grand_total_dollar' =>
                    $validated['grand_total_dollar'],

                    'sub_total_riel' =>
                    $validated['sub_total_riel'],

                    'grand_total_riel' =>
                    $validated['grand_total_riel'],

                    'cash_receive' =>
                    $validated['cash_receive'] ?? 0,

                    'cash_return' =>
                    $validated['cash_return'] ?? 0,

                    'exchange_rate' =>
                    $validated['exchange_rate'],
                ]);


                /*
            |--------------------------------------------------------------------------
            | Create Sale Details
            |--------------------------------------------------------------------------
            */

                foreach ($validated['items'] as $item) {

                    $product = Product::findOrFail(
                        $item['product_id']
                    );

                    SaleDetail::create([

                        'sale_id' =>
                        $sale->sale_id,
                        'product_id'=>$product->product_id,

                        'product_name_kh' =>
                        $product->product_name_kh,

                        'product_name_en' =>
                        $product->product_name_en,

                        'qty' =>
                        $item['qty'],

                        'price' =>
                        $item['price'],

                        'avatar' =>
                        $product->avatar,
                    ]);
                }


                /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

                session()->forget('cart');


                return $sale;
            });


            /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

            return response()->json([

                'success' => true,

                'message' =>
                'Sale completed successfully.',

                'sale_id' =>
                $sale->sale_id,

                'redirect' =>
                route('actions.index'),
            ]);
        } catch (\Throwable $e) {

            report($e);

            return response()->json([

                'success' => false,

                'message' =>
                $e->getMessage(),

            ], 500);
        }
    }
}
