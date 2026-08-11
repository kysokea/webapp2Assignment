{{-- <div class="col-xl-4 col-lg-5"> --}}

    <div class="checkout-card">

        {{-- Checkout Header --}}
        <div class="checkout-header">

            <div>
                <h5>
                    <i class="fas fa-shopping-bag text-primary mr-2"></i>
                    Current Sale
                </h5>

                <small>
                    3 items selected
                </small>
            </div>

            <button class="clear-btn">
                Clear
            </button>

        </div>





        {{-- Cart Items --}}
        <div class="cart-list">


            {{-- Cart Item --}}
            <a href="" class="cart-product">

                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200">

                <div class="cart-product-info">

                    <strong>
                        Nike Air Max
                    </strong>

                    <small>
                        $89.00 / item
                    </small>

                    <div class="quantity">

                        <button>
                            <i class="fas fa-minus"></i>
                        </button>

                        <span>1</span>

                        <button>
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>

                </div>

                <div class="cart-price">

                    <strong>
                        $89.00
                    </strong>

                    <button>
                        <i class="fas fa-trash-alt"></i>
                    </button>

                </div>

            </a>



            {{-- Cart Item --}}
            {{-- <div class="cart-product">

                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200">

                <div class="cart-product-info">

                    <strong>
                        Classic Watch
                    </strong>

                    <small>
                        $120.00 / item
                    </small>

                    <div class="quantity">

                        <button>
                            <i class="fas fa-minus"></i>
                        </button>

                        <span>2</span>

                        <button>
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>

                </div>

                <div class="cart-price">

                    <strong>
                        $240.00
                    </strong>

                    <button>
                        <i class="fas fa-trash-alt"></i>
                    </button>

                </div>

            </div> --}}


        </div>


        {{-- Summary --}}
        <div class="summary">

            <div>
                <span>Subtotal</span>
                <strong>$329.00</strong>
            </div>

            <div>
                <span>Discount</span>

                <div class="discount">
                    <input type="text" value="0">
                    <span>$</span>
                </div>
            </div>

            <div>
                <span>Tax</span>
                <strong>$32.90</strong>
            </div>

        </div>


        {{-- Total --}}
        <div class="grand-total">

            <span>Total</span>

            <strong>
                $361.90
            </strong>

        </div>


        {{-- Payment --}}
        <div class="payment-section">

            <label>
                Payment Method
            </label>

            <div class="payment-buttons">

                <button class="payment active">

                    <i class="fas fa-money-bill-wave"></i>

                    <span>Cash</span>

                </button>

                <button class="payment">

                    <i class="fas fa-credit-card"></i>

                    <span>Card</span>

                </button>

                <button class="payment">

                    <i class="fas fa-qrcode"></i>

                    <span>QR Pay</span>

                </button>

            </div>

        </div>


        {{-- Checkout --}}
        <button class="checkout-btn">

            <span>
                Complete Sale
            </span>

            <strong>
                $361.90
            </strong>

            <i class="fas fa-arrow-right"></i>

        </button>

    </div>

{{-- </div> --}}
