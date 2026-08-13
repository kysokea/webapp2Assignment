{{-- =========================================
CHECKOUT / CART
========================================= --}}

@php
$subtotal = collect($cart)->sum(function ($item) {
    return $item['price'] * $item['quantity'];
});

$discount = 0;
$total = $subtotal - $discount;

// Set this from your settings/config table if you have one,
// or pass it in from the controller. Hardcoded here as a fallback.
$exchangeRate = $exchangeRate ?? 4100;
@endphp


<div class="checkout-card">

    {{-- =========================================
    HEADER
    ========================================== --}}

    <div class="checkout-header">

        <div>
            <h5>
                <i class="fas fa-shopping-bag text-primary mr-2"></i>
                Current Sale
            </h5>

            <small>
                <span id="item-count">
                    {{ collect($cart)->sum('quantity') }}
                </span>
                items selected
            </small>
        </div>

        <a href="{{ route('action.clearCart') }}" class="clear-btn">
            Clear
        </a>

    </div>

    {{-- =========================================
    CUSTOMER
    ========================================== --}}

    <div class="customer-section mb-3">
        <label for="customer_id">Customer</label>
        <select id="customer_id" name="customer_id" class="form-control">
            <option value="">Walk-in customer</option>
            @foreach ($customers ?? [] as $customer)
                <option value="{{ $customer->customer_id }}">
                    {{ $customer->customer_desc_en }}
                </option>
            @endforeach
        </select>
    </div>


    {{-- =========================================
    CART ITEMS
    ========================================== --}}

    <div class="cart-list">

        @forelse ($cart as $item)

            <div class="cart-product" data-product-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}">

                {{-- Image --}}
                @if (!empty($item['avatar']))
                    <img src="{{ asset('storage/img/' . $item['avatar']) }}" alt="{{ $item['name'] }}">
                @else
                    <img src="{{ asset('storage/img/empty-img.png') }}" alt="No Image">
                @endif

                {{-- Product Info --}}
                <div class="cart-product-info">

                    <strong>
                        {{ $item['name'] }}
                    </strong>

                    <small>
                        ${{ number_format($item['price'], 2) }} / item
                    </small>

                    {{-- Quantity --}}
                    <div class="quantity d-flex justify-content-between align-items-center" style="max-width:110px;">

                        <button type="button" class="quantity-minus">
                            <i class="fas fa-minus"></i>
                        </button>

                        <input type="number" class="quantity-input text-center" value="{{ $item['quantity'] }}" min="1"
                            style="max-width:45px;">

                        <button type="button" class="quantity-plus">
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>

                </div>

                {{-- Price --}}
                <div class="cart-price">

                    <strong class="item-total">
                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                    </strong>

                    <a href="{{ route('action.cart.remove', $item['id']) }}" class="remove-btn" title="Remove product">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </a>

                </div>

            </div>

        @empty

            <div class="text-center py-4 text-muted">
                <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                <p class="mb-0">No products selected</p>
            </div>

        @endforelse

    </div>


    {{-- =========================================
    DIVIDER
    ========================================== --}}

    <div class="checkout-divider"></div>


    {{-- =========================================
    SUMMARY
    ========================================== --}}

    <div class="summary">

        <div>
            <span>Subtotal</span>
            <strong id="subtotal">${{ number_format($subtotal, 2) }}</strong>
        </div>

        <div>
            <span>Discount</span>
            <div class="discount">
                <input type="number" id="discount" value="0" min="0" step="0.01">
                <span>$</span>
            </div>
        </div>

        <div>
            <span>Exchange Rate</span>
            <strong id="exchange-rate-display">{{ number_format($exchangeRate) }} ៛</strong>
        </div>

    </div>


    {{-- =========================================
    GRAND TOTAL
    ========================================== --}}

    <div class="grand-total">
        <span>Total (USD)</span>
        <strong id="grand-total">${{ number_format($total, 2) }}</strong>
    </div>

    <div class="grand-total-riel">
        <span>Total (KHR)</span>
        <strong id="grand-total-riel">{{ number_format($total * $exchangeRate) }} ៛</strong>
    </div>


    {{-- =========================================
    PAYMENT
    ========================================== --}}

    <div class="payment-section">

        <label>Payment Method</label>

        <div class="payment-buttons">

            <button type="button" class="payment active" data-payment="cash">
                <i class="fas fa-money-bill-wave"></i>
                <span>Cash</span>
            </button>

            <button type="button" class="payment" data-payment="card">
                <i class="fas fa-credit-card"></i>
                <span>Card</span>
            </button>

            <button type="button" class="payment" data-payment="qr">
                <i class="fas fa-qrcode"></i>
                <span>QR Pay</span>
            </button>

        </div>

        <form id="checkout-form" class="w-100 py-4" method="POST" action="{{ route('action.checkout.store') }}"
            data-checkout-url="{{ route('action.checkout.store') }}">
            @csrf

            <input type="hidden" id="payment_method" name="payment_method" value="cash">
            <input type="hidden" id="customer_id_hidden" name="customer_id" value="">
            <input type="hidden" id="discount_hidden" name="discount" value="0">
            <input type="hidden" id="exchange_rate_hidden" name="exchange_rate" value="{{ $exchangeRate }}">
            <input type="hidden" id="sub_total_dollar" name="sub_total_dollar" value="{{ $subtotal }}">
            <input type="hidden" id="grand_total_dollar" name="grand_total_dollar" value="{{ $total }}">
            <input type="hidden" id="sub_total_riel" name="sub_total_riel" value="{{ $subtotal * $exchangeRate }}">
            <input type="hidden" id="grand_total_riel" name="grand_total_riel" value="{{ $total * $exchangeRate }}">
            <input type="hidden" id="items_json" name="items_json" value="">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="cash-in" class="mb-0">Cash In</label>
                <input type="number" id="cash-in" class="max-w-1/3" min="0" step="0.01" placeholder="0.00">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="mb-0">Cash Return</label>
                <span id="cash-return">$0.00</span>
            </div>

            <button type="submit" class="checkout-btn text-center m-0 w-100" id="complete-sale" disabled>
                Sale
            </button>

        </form>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const products = document.querySelectorAll('.cart-product');
        const discountInput = document.getElementById('discount');
        const customerSelect = document.getElementById('customer_id');
        const cashInInput = document.getElementById('cash-in');
        const completeSaleBtn = document.getElementById('complete-sale');
        const checkoutForm = document.getElementById('checkout-form');
        console.log('checkoutForm found:', checkoutForm);
        const exchangeRate = parseFloat(document.getElementById('exchange_rate_hidden').value) || 4100;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let currentSubtotal = 0;
        let currentTotal = 0;

        /*
        |--------------------------------------------------------------------------
        | Calculate Cart
        |--------------------------------------------------------------------------
        */
        function calculateCart() {

            let subtotal = 0;
            let itemCount = 0;

            products.forEach(function (product) {

                const price = parseFloat(product.dataset.price) || 0;
                const quantityInput = product.querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value) || 1;

                if (quantity < 1) {
                    quantity = 1;
                    quantityInput.value = 1;
                }

                const itemTotal = price * quantity;
                subtotal += itemTotal;
                itemCount += quantity;

                const itemTotalElement = product.querySelector('.item-total');
                if (itemTotalElement) {
                    itemTotalElement.textContent = '$' + itemTotal.toFixed(2);
                }

            });

            let discount = parseFloat(discountInput.value) || 0;
            if (discount < 0) {
                discount = 0;
                discountInput.value = 0;
            }
            if (discount > subtotal) {
                discount = subtotal;
                discountInput.value = subtotal.toFixed(2);
            }

            const total = subtotal - discount;

            currentSubtotal = subtotal;
            currentTotal = total;

            document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('grand-total').textContent = '$' + total.toFixed(2);
            document.getElementById('grand-total-riel').textContent =
                Math.round(total * exchangeRate).toLocaleString() + ' ៛';
            document.getElementById('item-count').textContent = itemCount;

            // sync hidden fields for submission
            document.getElementById('sub_total_dollar').value = subtotal.toFixed(2);
            document.getElementById('grand_total_dollar').value = total.toFixed(2);
            document.getElementById('sub_total_riel').value = (subtotal * exchangeRate).toFixed(0);
            document.getElementById('grand_total_riel').value = (total * exchangeRate).toFixed(0);
            document.getElementById('discount_hidden').value = discount.toFixed(2);

            calculateCashReturn();
        }

        /*
        |--------------------------------------------------------------------------
        | Cash In / Cash Return
        |--------------------------------------------------------------------------
        */
        function calculateCashReturn() {

            const cashIn = parseFloat(cashInInput.value) || 0;
            const change = cashIn - currentTotal;

            document.getElementById('cash-return').textContent =
                '$' + (change > 0 ? change.toFixed(2) : '0.00');

            // Only enable "Sale" once cash in covers the total (skip this check for card/QR)
            const paymentMethod = document.getElementById('payment_method').value;
            const hasItems = products.length > 0;

            if (paymentMethod === 'cash') {
                completeSaleBtn.disabled = !(hasItems && cashIn >= currentTotal);
            } else {
                completeSaleBtn.disabled = !hasItems;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save Quantity To Laravel Session
        |--------------------------------------------------------------------------
        */
        function updateQuantity(product, quantity) {

            const productId = product.dataset.productId;

            fetch(`/action/cart/update/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Quantity update failed');
                    }
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
        }

        /* PLUS */
        document.querySelectorAll('.quantity-plus').forEach(function (button) {
            button.addEventListener('click', function () {
                const product = button.closest('.cart-product');
                const input = product.querySelector('.quantity-input');
                let quantity = (parseInt(input.value) || 1) + 1;
                input.value = quantity;
                calculateCart();
                updateQuantity(product, quantity);
            });
        });

        /* MINUS */
        document.querySelectorAll('.quantity-minus').forEach(function (button) {
            button.addEventListener('click', function () {
                const product = button.closest('.cart-product');
                const input = product.querySelector('.quantity-input');
                let quantity = parseInt(input.value) || 1;
                if (quantity > 1) {
                    quantity--;
                    input.value = quantity;
                    calculateCart();
                    updateQuantity(product, quantity);
                }
            });
        });

        /* MANUAL INPUT */
        document.querySelectorAll('.quantity-input').forEach(function (input) {
            input.addEventListener('change', function () {
                const product = input.closest('.cart-product');
                let quantity = parseInt(input.value) || 1;
                if (quantity < 1) quantity = 1;
                input.value = quantity;
                calculateCart();
                updateQuantity(product, quantity);
            });
        });

        /* DISCOUNT */
        if (discountInput) {
            discountInput.addEventListener('input', calculateCart);
        }

        /* CASH IN */
        if (cashInInput) {
            cashInInput.addEventListener('input', calculateCashReturn);
        }

        /* CUSTOMER */
        if (customerSelect) {
            customerSelect.addEventListener('change', function () {
                document.getElementById('customer_id_hidden').value = customerSelect.value;
            });
        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT BUTTONS
        |--------------------------------------------------------------------------
        */
        document.querySelectorAll('.payment').forEach(function (button) {
            button.addEventListener('click', function () {

                document.querySelectorAll('.payment').forEach(function (item) {
                    item.classList.remove('active');
                });

                button.classList.add('active');
                document.getElementById('payment_method').value = button.dataset.payment;

                calculateCashReturn();
            });
        });

        /*
        |--------------------------------------------------------------------------
        | SUBMIT SALE -> creates sales, sale_details, payments rows
        |--------------------------------------------------------------------------
        */
        const checkoutUrl = checkoutForm.dataset.checkoutUrl;

        checkoutForm.addEventListener('submit', function (e) {
            console.log('Submit event fired, preventing default...');
            e.preventDefault();

            const paymentMethod = document.getElementById('payment_method').value;
            const cashIn = parseFloat(cashInInput.value) || 0;

            if (products.length === 0) {
                alert('Cart is empty.');
                return;
            }

            // Guard: cash must cover the total
            if (paymentMethod === 'cash' && cashIn < currentTotal) {
                alert('Cash received is not enough to cover the total.');
                return;
            }

            const items = Array.from(products).map(function (product) {
                return {
                    product_id: product.dataset.productId,
                    price: parseFloat(product.dataset.price),
                    qty: parseInt(product.querySelector('.quantity-input').value) || 1
                };
            });

            const payload = {
                customer_id: document.getElementById('customer_id_hidden').value || null,
                payment_method: paymentMethod,
                discount: parseFloat(document.getElementById('discount_hidden').value) || 0,
                exchange_rate: exchangeRate,
                sub_total_dollar: parseFloat(document.getElementById('sub_total_dollar').value),
                grand_total_dollar: parseFloat(document.getElementById('grand_total_dollar').value),
                sub_total_riel: parseFloat(document.getElementById('sub_total_riel').value),
                grand_total_riel: parseFloat(document.getElementById('grand_total_riel').value),
                cash_receive: cashIn,
                cash_return: parseFloat(document.getElementById('cash-return').textContent.replace('$', '')) || 0,
                items: items
            };

            completeSaleBtn.disabled = true;
            completeSaleBtn.textContent = 'Processing...';

            fetch(checkoutUrl, {
                method: 'POST',
                // credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Sale completed successfully!');
                        window.location.href = data.redirect ?? '/';
                    } else {
                        alert(data.message || 'Failed to complete sale.');
                        completeSaleBtn.disabled = false;
                        completeSaleBtn.textContent = 'Sale';
                    }
                })
                .catch(error => {
                    console.error('Checkout error:', error);
                    // Laravel validation errors come back as { message, errors: {...} }
                    const message = error.errors
                        ? Object.values(error.errors).flat().join('\n')
                        : (error.message || 'Something went wrong completing the sale.');
                    alert(message);
                    completeSaleBtn.disabled = false;
                    completeSaleBtn.textContent = 'Sale';
                });
        });
        /* Initial Calculation */
        calculateCart();

    });
</script>
