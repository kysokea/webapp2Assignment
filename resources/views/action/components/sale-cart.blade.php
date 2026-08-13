{{-- =========================================
CHECKOUT / CART
========================================= --}}
@php
$subtotal = collect($cart)->sum(function ($item) {
    return $item['price'] * $item['quantity'];
});

$total = $subtotal;
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
    <div class="customer-section mb-3 px-3">
        <label for="customer-select">Customer</label>

        <select id="customer-select" class="form-control @error('customer_id') is-invalid @enderror">
            <option value="">-- Walk-in Customer --</option>

            @foreach ($customers as $customer)
                <option value="{{ $customer->customer_id }}" {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                    {{ $customer->customer_type_en }}
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
    <div class="grand-total-riel px-3">
        <span>Total (KHR)</span>
        <strong id="grand-total-riel">{{ number_format($total * $exchangeRate) }} ៛</strong>
    </div>
    {{-- =========================================
    PAYMENT
    ========================================== --}}
    <div class="payment-section">
        <label>Payment Method</label>
        <div class="payment-section">
            <label for="payment-select">Payment Method</label>

            <select id="payment-select" class="form-control @error('payment_id') is-invalid @enderror">
                <option value="">-- Select payment --</option>

                @foreach ($payments as $payment)
                    <option value="{{ $payment->payment_id }}" data-method="{{ strtolower($payment->payment_method_en) }}"
                        {{ old('payment_id') == $payment->payment_id ? 'selected' : '' }}>
                        {{ $payment->payment_method_en }}
                    </option>
                @endforeach
            </select>
        </div>

        {{--
        NOTE: fill in the actual route for completing a sale.
        Both action and data-checkout-url must point at it since
        the form is submitted via fetch(), not a native POST.
        --}}
        <form id="checkout-form" class="w-100 py-4" method="POST" action="{{ route('action.checkout') }}"
            data-checkout-url="{{ route('action.checkout') }}">
            @csrf

            {{-- Selected customer --}}
            <input type="hidden" id="customer_id_hidden" name="customer_id" value="">

            {{-- Selected payment --}}
            <input type="hidden" id="payment_id_hidden" name="payment_id" value="">

            {{-- Payment method --}}
            <input type="hidden" id="payment_method" name="payment_method" value="">


            <input type="hidden" id="exchange_rate_hidden" name="exchange_rate" value="{{ $exchangeRate }}">

            <input type="hidden" id="sub_total_dollar" name="sub_total_dollar" value="{{ $subtotal }}">

            <input type="hidden" id="grand_total_dollar" name="grand_total_dollar" value="{{ $total }}">

            <input type="hidden" id="sub_total_riel" name="sub_total_riel" value="{{ $subtotal * $exchangeRate }}">

            <input type="hidden" id="grand_total_riel" name="grand_total_riel" value="{{ $total * $exchangeRate }}">

            <input type="hidden" id="items_json" name="items_json" value="">

            {{-- Cash received --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="cash-in-dollar" class="mb-0">
                    Cash In Dollar
                </label>

                <input type="number" id="cash-in-dollar" class="form-control" style="max-width: 150px" min="0"
                    step="0.01" placeholder="0.00">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="cash-in-riel" class="mb-0">
                    Cash In Riel
                </label>

                <input type="number" id="cash-in-riel" class="form-control" style="max-width: 150px" min="0" step="0.01"
                    placeholder="0.00">
            </div>

            {{-- Cash return --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="mb-0">
                    Cash Return
                </label>

                <strong id="cash-return" class="text-success">
                    $0.00
                </strong>
            </div>

            <button type="submit" class="checkout-btn" id="complete-sale" disabled style="margin: 0">

                <span class="sale-button-content">
                    <span id="sale-button-text">Sale</span>

                    <span id="sale-button-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true">
                    </span>
                </span>

            </button>

        </form>

    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999;">

        <div id="checkoutToast" class="toast align-items-center border-0" role="alert" aria-live="assertive"
            aria-atomic="true">

            <div class="d-flex">

                <div id="checkoutToastBody" class="toast-body">
                    Sale completed successfully!
                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close">
                </button>

            </div>

        </div>

    </div>
</div>

<script>

    /* =========================================================
       BOOTSTRAP TOAST
    ========================================================= */





    document.addEventListener('DOMContentLoaded', function () {
        const checkoutToastElement =
            document.getElementById('checkoutToast');

        const checkoutToastBody =
            document.getElementById('checkoutToastBody');
        function showToast(message, type = 'success') {

            if (!checkoutToastElement) {
                return;
            }

            /* Remove previous colors */
            checkoutToastElement.classList.remove(
                'text-bg-success',
                'text-bg-danger',
                'text-bg-warning',
                'text-bg-info'
            );

            /* Set toast color */
            switch (type) {

                case 'success':
                    checkoutToastElement.classList.add(
                        'text-bg-success'
                    );
                    break;

                case 'error':
                    checkoutToastElement.classList.add(
                        'text-bg-danger'
                    );
                    break;

                case 'warning':
                    checkoutToastElement.classList.add(
                        'text-bg-warning'
                    );
                    break;

                case 'info':
                    checkoutToastElement.classList.add(
                        'text-bg-info'
                    );
                    break;

                default:
                    checkoutToastElement.classList.add(
                        'text-bg-success'
                    );
            }

            /* Set message */
            checkoutToastBody.textContent = message;

            /* Create Bootstrap Toast */
            const toast =
                bootstrap.Toast.getOrCreateInstance(
                    checkoutToastElement,
                    {
                        delay: 3000
                    }
                );

            /* Show */
            toast.show();
        }

        /* =========================================================
           ELEMENTS
        ========================================================= */

        const products = document.querySelectorAll('.cart-product');

        const customerSelect =
            document.getElementById('customer-select');

        const paymentSelect =
            document.getElementById('payment-select');

        const cashInInputDollar =
            document.getElementById('cash-in-dollar');

        const cashInInputRiel =
            document.getElementById('cash-in-riel');

        const completeSaleBtn =
            document.getElementById('complete-sale');

        const checkoutForm =
            document.getElementById('checkout-form');

        const customerHidden =
            document.getElementById('customer_id_hidden');

        const paymentHidden =
            document.getElementById('payment_id_hidden');

        const paymentMethodHidden =
            document.getElementById('payment_method');

        const itemsJsonHidden =
            document.getElementById('items_json');

        const cashReturnElement =
            document.getElementById('cash-return');

        const exchangeRate =
            parseFloat(
                document.getElementById('exchange_rate_hidden').value
            ) || 4100;

        const csrfToken =
            document.querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');


        /* =========================================================
           CURRENT VALUES
        ========================================================= */

        let currentSubtotal = 0;
        let currentTotal = 0;


        /* =========================================================
           GET PAYMENT METHOD
        ========================================================= */

        function getPaymentMethod() {

            if (!paymentSelect) {
                return '';
            }

            const selectedOption =
                paymentSelect.options[paymentSelect.selectedIndex];

            if (!selectedOption) {
                return '';
            }

            return (
                selectedOption.dataset.method || ''
            ).toLowerCase();
        }


        /* =========================================================
           CHECK IF PAYMENT IS CASH
        ========================================================= */

        function isCashPayment() {

            const method = getPaymentMethod();

            return (
                method === 'cash' ||
                method === 'cash payment'
            );
        }


        /* =========================================================
           CASH TOTALS (single source of truth)
           Used by both calculateCashReturn() and the submit handler
           so we never reference an out-of-scope variable again.
        ========================================================= */

        function getCashTotals() {

            const cashInDollar =
                parseFloat(cashInInputDollar?.value) || 0;

            const cashInRiel =
                parseFloat(cashInInputRiel?.value) || 0;

            const cashRielInDollar =
                cashInRiel / exchangeRate;

            const totalCashReceived =
                cashInDollar + cashRielInDollar;

            return {
                cashInDollar,
                cashInRiel,
                totalCashReceived
            };
        }


        /* =========================================================
           CALCULATE CART
        ========================================================= */

        function calculateCart() {

            let subtotal = 0;
            let itemCount = 0;

            products.forEach(function (product) {

                const price =
                    parseFloat(product.dataset.price) || 0;

                const quantityInput =
                    product.querySelector('.quantity-input');

                let quantity =
                    parseInt(quantityInput.value) || 1;

                if (quantity < 1) {
                    quantity = 1;
                    quantityInput.value = 1;
                }

                const itemTotal =
                    price * quantity;

                subtotal += itemTotal;
                itemCount += quantity;


                /* Update item total */

                const itemTotalElement =
                    product.querySelector('.item-total');

                if (itemTotalElement) {

                    itemTotalElement.textContent =
                        '$' + itemTotal.toFixed(2);
                }

            });


            /* =====================================================
               GRAND TOTAL
            ===================================================== */

            const total = subtotal;

            currentSubtotal = subtotal;
            currentTotal = total;


            /* =====================================================
               UPDATE DISPLAY
            ===================================================== */

            document.getElementById('subtotal')
                .textContent =
                '$' + subtotal.toFixed(2);

            document.getElementById('grand-total')
                .textContent =
                '$' + total.toFixed(2);

            document.getElementById('grand-total-riel')
                .textContent =
                Math.round(
                    total * exchangeRate
                ).toLocaleString() + ' ៛';

            document.getElementById('item-count')
                .textContent = itemCount;


            /* =====================================================
               UPDATE HIDDEN INPUTS
            ===================================================== */

            document.getElementById('sub_total_dollar')
                .value =
                subtotal.toFixed(2);

            document.getElementById('grand_total_dollar')
                .value =
                total.toFixed(2);

            document.getElementById('sub_total_riel')
                .value =
                Math.round(
                    subtotal * exchangeRate
                );

            document.getElementById('grand_total_riel')
                .value =
                Math.round(
                    total * exchangeRate
                );

            /* Recalculate cash */

            calculateCashReturn();

            /* Validate sale */

            validateSale();
        }


        /* =========================================================
           CASH RETURN
        ========================================================= */

        function calculateCashReturn() {

            // Non-cash payment
            if (!isCashPayment()) {
                cashReturnElement.textContent = '$0.00';
                return;
            }

            const { totalCashReceived } = getCashTotals();

            // Calculate change
            const change =
                totalCashReceived - currentTotal;

            if (change > 0) {

                const changeRiel =
                    Math.round(change * exchangeRate);

                cashReturnElement.innerHTML =
                    '$' + change.toFixed(2) +
                    ' <small class="text-muted">(' +
                    changeRiel.toLocaleString() +
                    ' ៛)</small>';

            } else {

                cashReturnElement.textContent =
                    '$0.00';
            }
        }


        /* =========================================================
           VALIDATE SALE
        ========================================================= */

        function validateSale() {

            const hasItems =
                products.length > 0;

            const paymentSelected =
                paymentHidden.value !== '';

            const cashPayment =
                isCashPayment();

            const { totalCashReceived } = getCashTotals();

            let valid = true;

            // Cart must contain products
            if (!hasItems) {
                valid = false;
            }

            // Payment must be selected
            if (!paymentSelected) {
                valid = false;
            }

            // Cash payment must have enough money
            if (cashPayment) {

                if (totalCashReceived < currentTotal) {
                    valid = false;
                }
            }

            completeSaleBtn.disabled = !valid;
        }

        /* =========================================================
           UPDATE QUANTITY
        ========================================================= */

        function updateQuantity(product, quantity) {

            const productId =
                product.dataset.productId;

            fetch(
                `/action/cart/update/${productId}`,
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify({
                        quantity: quantity
                    })
                }
            )
                .then(response => response.json())
                .then(data => {

                    if (!data.success) {

                        console.error(
                            'Quantity update failed'
                        );
                    }
                })
                .catch(error => {

                    console.error(
                        'Error updating quantity:',
                        error
                    );
                });
        }


        /* =========================================================
           PLUS
        ========================================================= */

        document
            .querySelectorAll('.quantity-plus')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const product =
                            button.closest('.cart-product');

                        const input =
                            product.querySelector(
                                '.quantity-input'
                            );

                        let quantity =
                            parseInt(input.value) || 1;

                        quantity++;

                        input.value = quantity;

                        calculateCart();

                        updateQuantity(
                            product,
                            quantity
                        );
                    }
                );
            });


        /* =========================================================
           MINUS
        ========================================================= */

        document
            .querySelectorAll('.quantity-minus')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const product =
                            button.closest('.cart-product');

                        const input =
                            product.querySelector(
                                '.quantity-input'
                            );

                        let quantity =
                            parseInt(input.value) || 1;

                        if (quantity > 1) {

                            quantity--;

                            input.value =
                                quantity;

                            calculateCart();

                            updateQuantity(
                                product,
                                quantity
                            );
                        }
                    }
                );
            });


        /* =========================================================
           MANUAL QUANTITY
        ========================================================= */

        document
            .querySelectorAll('.quantity-input')
            .forEach(function (input) {

                input.addEventListener(
                    'change',
                    function () {

                        const product =
                            input.closest('.cart-product');

                        let quantity =
                            parseInt(input.value) || 1;

                        if (quantity < 1) {
                            quantity = 1;
                        }

                        input.value = quantity;

                        calculateCart();

                        updateQuantity(
                            product,
                            quantity
                        );
                    }
                );
            });



        /* =========================================================
           CASH INPUT
        ========================================================= */

        if (cashInInputDollar) {

            cashInInputDollar.addEventListener(
                'input',
                function () {

                    calculateCashReturn();
                    validateSale();
                }
            );
        }

        if (cashInInputRiel) {

            cashInInputRiel.addEventListener(
                'input',
                function () {

                    calculateCashReturn();
                    validateSale();
                }
            );
        }


        /* =========================================================
           CUSTOMER
        ========================================================= */

        if (customerSelect) {

            customerSelect.addEventListener(
                'change',
                function () {

                    customerHidden.value =
                        customerSelect.value || '';

                    validateSale();
                }
            );
        }


        /* =========================================================
           PAYMENT
        ========================================================= */

        if (paymentSelect) {

            paymentSelect.addEventListener(
                'change',
                function () {

                    const selectedOption =
                        paymentSelect.options[
                        paymentSelect.selectedIndex
                        ];


                    /* Save payment ID */

                    paymentHidden.value =
                        paymentSelect.value || '';


                    /* Save payment method */

                    paymentMethodHidden.value =
                        selectedOption?.dataset.method || '';


                    /* Clear cash if non-cash */

                    if (!isCashPayment()) {

                        cashInInputDollar.value = '';
                        cashInInputRiel.value = '';

                        cashReturnElement.textContent =
                            '$0.00';
                    }


                    calculateCashReturn();

                    validateSale();
                }
            );
        }


        /* =========================================================
           SUBMIT SALE
        ========================================================= */

        checkoutForm.addEventListener(
            'submit',
            function (e) {

                e.preventDefault();


                /* Validate cart */

                if (products.length === 0) {

                    alert(
                        'Cart is empty.'
                    );

                    return;
                }


                /* Validate payment */

                if (!paymentHidden.value) {

                    alert(
                        'Please select a payment method.'
                    );

                    return;
                }


                /* Cash validation */

                const { totalCashReceived } = getCashTotals();

                if (
                    isCashPayment() &&
                    totalCashReceived < currentTotal
                ) {

                    alert(
                        'Cash received is not enough.'
                    );

                    cashInInputDollar.focus();

                    return;
                }


                /* =================================================
                   BUILD ITEMS
                ================================================= */

                const items =
                    Array.from(products)
                        .map(function (product) {

                            return {

                                product_id:
                                    product.dataset.productId,

                                price:
                                    parseFloat(
                                        product.dataset.price
                                    ) || 0,

                                qty:
                                    parseInt(
                                        product.querySelector(
                                            '.quantity-input'
                                        ).value
                                    ) || 1
                            };
                        });

                itemsJsonHidden.value =
                    JSON.stringify(items);


                /* =================================================
                   CASH RETURN
                ================================================= */

                const change =
                    isCashPayment()
                        ? Math.max(
                            totalCashReceived - currentTotal,
                            0
                        )
                        : 0;

                const changeRiel =
                    Math.round(change * exchangeRate);


                /* =================================================
                   PAYLOAD
                ================================================= */

                const payload = {

                    customer_id:
                        customerHidden.value || null,

                    payment_id:
                        paymentHidden.value,

                    payment_method:
                        paymentMethodHidden.value,

                    exchange_rate:
                        exchangeRate,

                    sub_total_dollar:
                        currentSubtotal,

                    grand_total_dollar:
                        currentTotal,

                    sub_total_riel:
                        Math.round(
                            currentSubtotal *
                            exchangeRate
                        ),

                    grand_total_riel:
                        Math.round(
                            currentTotal *
                            exchangeRate
                        ),

                    cash_receive:
                        isCashPayment()
                            ? totalCashReceived
                            : 0,

                    cash_return:
                        change,

                    cash_return_riel:
                        changeRiel,

                    items:
                        items
                };


                /* =================================================
                   DISABLE BUTTON
                ================================================= */

                completeSaleBtn.disabled =
                    true;

                completeSaleBtn.textContent =
                    'Processing...';


                /* =================================================
                   CHECKOUT URL
                ================================================= */

                const checkoutUrl =
                    checkoutForm.dataset.checkoutUrl;


                /* =================================================
                   SEND TO LARAVEL
                ================================================= */

                fetch(
                    checkoutUrl,
                    {
                        method: 'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'X-CSRF-TOKEN':
                                csrfToken,

                            'Accept':
                                'application/json'
                        },

                        body:
                            JSON.stringify(payload)
                    }
                )
                    .then(response => {

                        if (!response.ok) {

                            return response
                                .json()
                                .then(error => {

                                    throw error;
                                });
                        }

                        return response.json();
                    })
                    .then(data => {

                        if (data.success) {

                            showToast(
                                'Sale completed successfully!',
                                'success'
                            );

                            setTimeout(() => {
                                window.location.href =
                                    data.redirect || '/';
                            }, 1500);

                        } else {

                            showToast(
                                data.message ||
                                'Failed to complete sale.',
                                'error'
                            );

                            completeSaleBtn.disabled = false;
                            completeSaleBtn.textContent = 'Sale';
                        }

                    })
                    .catch(error => {

                        console.error('Checkout error:', error);

                        const message =
                            error.errors
                                ? Object.values(error.errors)
                                    .flat()
                                    .join('\n')
                                : (
                                    error.message ||
                                    'Something went wrong completing the sale.'
                                );

                        showToast(message, 'error');

                        completeSaleBtn.disabled = false;
                        completeSaleBtn.textContent = 'Sale';
                    });
            }
        );


        /* =========================================================
           INITIAL CALCULATION
        ========================================================= */

        calculateCart();

    });
</script>
