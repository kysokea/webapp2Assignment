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
            // Walk-in customers send null — must be nullable, not required.
            'customer_id'          => 'nullable|integer|exists:customers,customer_id',

            // Validate the actual FK the frontend sends (payment_id),
            // not the free-text payment_method against the wrong column.
            'payment_id'           => 'required|integer|exists:payments,payment_id',
            'product_id'           => 'required|integer|exists:products,product_id',

            'discount'              => 'nullable|numeric|min:0',
            'exchange_rate'         => 'required|numeric|min:0',
            'sub_total_dollar'      => 'required|numeric|min:0',
            'grand_total_dollar'    => 'required|numeric|min:0',
            'sub_total_riel'        => 'required|numeric|min:0',
            'grand_total_riel'      => 'required|numeric|min:0',
            'cash_receive'          => 'nullable|numeric|min:0',
            'cash_return'           => 'nullable|numeric|min:0',
            'items'                 => 'required|array|min:1',
            'items.*.product_id'    => 'required|integer|exists:products,product_id',
            'items.*.qty'           => 'required|integer|min:1',
            'items.*.price'         => 'required|numeric|min:0',
        ]);

        // Look up the payment method server-side rather than trusting
        // whatever string the client sent — prevents a tampered
        // payment_method from bypassing the cash-sufficiency check below.
        $payment = Payment::findOrFail($validated['payment_id']);
        $paymentMethod = strtolower($payment->payment_method_en ?? '');

        if (
            $paymentMethod === 'cash'
            && (float) ($validated['cash_receive'] ?? 0) < (float) $validated['grand_total_dollar']
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Cash received is not enough to cover the total.',
            ], 422);
        }

        try {
            $sale = DB::transaction(function () use ($validated, $paymentMethod) {

                $sale = Sale::create([
                    'customer_id'        => $validated['customer_id'] ?? null,
                    'user_id'            => auth()->id(),
                    'product_id' => $validated['product_id'] ?? null,
                    'sale_date'          => now(),
                    'discount'           => $validated['discount'] ?? 0,
                    'sub_total_dollar'   => $validated['sub_total_dollar'],
                    'grand_total_dollar' => $validated['grand_total_dollar'],
                    'sub_total_riel'     => $validated['sub_total_riel'],
                    'grand_total_riel'   => $validated['grand_total_riel'],
                    'cash_receive'       => $validated['cash_receive'] ?? 0,
                    'cash_return'        => $validated['cash_return'] ?? 0,
                    'exchange_rate'      => $validated['exchange_rate'],
                ]);

                foreach ($validated['items'] as $item) {

                    // Lock the product row while we check/adjust stock so two
                    // concurrent checkouts can't both oversell the same item.
                    // Remove this block if you don't track inventory on products.
                    $product = Product::whereKey($item['product_id'])
                        ->lockForUpdate()
                        ->first();

                    if ($product && isset($product->stock)) {
                        if ($product->stock < $item['qty']) {
                            throw new \RuntimeException(
                                "Not enough stock for product #{$item['product_id']}."
                            );
                        }
                        $product->decrement('stock', $item['qty']);
                    }

                    $product = Product::whereKey($item['product_id'])->lockForUpdate()->first();
                    // ... stock check as before ...
                    SaleDetail::create([
                        'sale_id'          => $sale->sale_id,
                        'product_name_kh'  => $product->product_name_kh,
                        'product_name_en'  => $product->product_name_en,
                        'qty'              => $item['qty'],
                        'price'            => $item['price'],
                        'avatar'           => $product->avatar,
                    ]);
                }

                Payment::create([
                    'sale_id'        => $sale->sale_id,
                    'payment_id'     => $payment->payment_id,
                    'payment_method_en' => $paymentMethod,
                ]);

                session()->forget('cart');

                return $sale;
            });

            return response()->json([
                'success'  => true,
                // Confirm this route name matches your routes file —
                // the original had 'actions.index' which doesn't match
                // the 'action.*' naming used elsewhere in this flow.
                'redirect' => route('actions.index'),
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => $e instanceof \RuntimeException
                    ? $e->getMessage()
                    : 'Failed to save sale to the database.',
            ], 500);
        }
    }
}
