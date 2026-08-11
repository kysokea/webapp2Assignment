{{-- =========================================
CHECKOUT / CART
========================================= --}}

@php
$subtotal = collect($cart)->sum(function ($item) {
    return $item['price'] * $item['quantity'];
});

$discount = 0;
$total = $subtotal - $discount;
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
                            ${{ number_format(
        $item['price'] * $item['quantity'],
        2
    ) }}
                        </strong>


                        <a href="{{ route('action.cart.remove', $item['id']) }}" class="remove-btn" title="Remove product">

                            <i class="fas fa-trash-alt text-danger"></i>

                        </a>

                    </div>

                </div>

        @empty

            <div class="text-center py-4 text-muted">

                <i class="fas fa-shopping-cart fa-2x mb-2"></i>

                <p class="mb-0">
                    No products selected
                </p>

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

        {{-- Subtotal --}}
        <div>

            <span>
                Subtotal
            </span>

            <strong id="subtotal">
                ${{ number_format($subtotal, 2) }}
            </strong>

        </div>


        {{-- Discount --}}
        <div>

            <span>
                Discount
            </span>

            <div class="discount">

                <input type="number" id="discount" value="0" min="0" step="0.01">

                <span>
                    $
                </span>

            </div>

        </div>

    </div>


    {{-- =========================================
    GRAND TOTAL
    ========================================== --}}

    <div class="grand-total">

        <span>
            Total
        </span>

        <strong id="grand-total">
            ${{ number_format($total, 2) }}
        </strong>

    </div>


    {{-- =========================================
    PAYMENT
    ========================================== --}}

    <div class="payment-section">

        <label>
            Payment Method
        </label>


        <div class="payment-buttons">

            {{-- Cash --}}
            <button type="button" class="payment active" data-payment="cash">

                <i class="fas fa-money-bill-wave"></i>

                <span>
                    Cash
                </span>

            </button>


            {{-- Card --}}
            <button type="button" class="payment" data-payment="card">

                <i class="fas fa-credit-card"></i>

                <span>
                    Card
                </span>

            </button>


            {{-- QR --}}
            <button type="button" class="payment" data-payment="qr">

                <i class="fas fa-qrcode"></i>

                <span>
                    QR Pay
                </span>

            </button>

        </div>

    </div>


    {{-- =========================================
    COMPLETE SALE
    ========================================== --}}

    <button type="button" class="checkout-btn" id="complete-sale">

        <span>
            Complete Sale
        </span>

        <strong id="checkout-total">
            ${{ number_format($total, 2) }}
        </strong>

        <i class="fas fa-arrow-right"></i>

    </button>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const TAX_RATE = 0.10;

        const products =
            document.querySelectorAll('.cart-product');

        const discountInput =
            document.getElementById('discount');

        const csrfToken =
            document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        /*
        |--------------------------------------------------------------------------
        | Calculate Cart
        |--------------------------------------------------------------------------
        */

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


                const itemTotalElement =
                    product.querySelector('.item-total');

                if (itemTotalElement) {
                    itemTotalElement.textContent =
                        '$' + itemTotal.toFixed(2);
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Discount
            |--------------------------------------------------------------------------
            */

            let discount =
                parseFloat(discountInput.value) || 0;

            if (discount < 0) {
                discount = 0;
                discountInput.value = 0;
            }

            if (discount > subtotal) {
                discount = subtotal;
                discountInput.value =
                    subtotal.toFixed(2);
            }


            /*
            |--------------------------------------------------------------------------
            | Tax
            |--------------------------------------------------------------------------
            */

            const taxableAmount =
                subtotal - discount;

            // const tax = 1
            // taxableAmount * TAX_RATE;


            /*
            |--------------------------------------------------------------------------
            | Total
            |--------------------------------------------------------------------------
            */

            const total =
                subtotal - discount;
            // subtotal - discount + tax;


            /*
            |--------------------------------------------------------------------------
            | Update UI
            |--------------------------------------------------------------------------
            */

            document.getElementById('subtotal').textContent =
                '$' + subtotal.toFixed(2);

            // document.getElementById('tax').textContent =
            //     '$' + tax.toFixed(2);

            document.getElementById('grand-total').textContent =
                '$' + total.toFixed(2);

            document.getElementById('checkout-total').textContent =
                '$' + total.toFixed(2);

            document.getElementById('item-count').textContent =
                itemCount;
        }


        /*
        |--------------------------------------------------------------------------
        | Save Quantity To Laravel Session
        |--------------------------------------------------------------------------
        */

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
                        console.error('Quantity update failed');
                    }

                })
                .catch(error => {

                    console.error(
                        'Error updating quantity:',
                        error
                    );

                });

        }


        /*
        |--------------------------------------------------------------------------
        | PLUS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.quantity-plus')
            .forEach(function (button) {

                button.addEventListener('click', function () {

                    const product =
                        button.closest('.cart-product');

                    const input =
                        product.querySelector('.quantity-input');

                    let quantity =
                        parseInt(input.value) || 1;

                    quantity++;

                    input.value = quantity;

                    calculateCart();

                    updateQuantity(
                        product,
                        quantity
                    );

                });

            });


        /*
        |--------------------------------------------------------------------------
        | MINUS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.quantity-minus')
            .forEach(function (button) {

                button.addEventListener('click', function () {

                    const product =
                        button.closest('.cart-product');

                    const input =
                        product.querySelector('.quantity-input');

                    let quantity =
                        parseInt(input.value) || 1;

                    if (quantity > 1) {

                        quantity--;

                        input.value = quantity;

                        calculateCart();

                        updateQuantity(
                            product,
                            quantity
                        );

                    }

                });

            });


        /*
        |--------------------------------------------------------------------------
        | MANUAL INPUT
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.quantity-input')
            .forEach(function (input) {

                input.addEventListener('change', function () {

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

                });

            });


        /*
        |--------------------------------------------------------------------------
        | DISCOUNT
        |--------------------------------------------------------------------------
        */

        if (discountInput) {

            discountInput.addEventListener(
                'input',
                function () {

                    calculateCart();

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PAYMENT BUTTONS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.payment')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        document
                            .querySelectorAll('.payment')
                            .forEach(function (item) {

                                item.classList.remove('active');

                            });

                        button.classList.add('active');

                    }
                );

            });


        /*
        |--------------------------------------------------------------------------
        | Initial Calculation
        |--------------------------------------------------------------------------
        */

        calculateCart();

    });
</script>
