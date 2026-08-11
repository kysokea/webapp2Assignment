@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="font-weight-bold mb-1">
                    <i class="fas fa-cash-register text-primary mr-2"></i>
                    New Sale
                </h3>

                <p class="text-muted mb-0">
                    Select products to create a new sale
                </p>
            </div>

            <div>
                <span class="sale-number">
                    <i class="fas fa-receipt mr-1"></i>
                    SALE #000125
                </span>
            </div>

        </div>


        <div class="row">

            {{-- ===================================================== --}}
            {{-- LEFT : PRODUCT SECTION --}}
            {{-- ===================================================== --}}
            <div class="col-xl-8 col-lg-7">

                <div class="sale-panel">

                    {{-- Search --}}
                    <div class="sale-toolbar">

                        <div class="search-box">

                            <i class="fas fa-search"></i>

                            <input
                                type="text"
                                placeholder="Search product..."
                            >

                            <span class="shortcut">
                                /
                            </span>

                        </div>

                        <button class="filter-btn">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>

                    </div>


                    {{-- Categories --}}
                    <div class="category-list">

                        <button class="category active">
                            <i class="fas fa-th-large"></i>
                            All
                        </button>

                        <button class="category">
                            <i class="fas fa-mobile-alt"></i>
                            Electronics
                        </button>

                        <button class="category">
                            <i class="fas fa-coffee"></i>
                            Drinks
                        </button>

                        <button class="category">
                            <i class="fas fa-utensils"></i>
                            Food
                        </button>

                        <button class="category">
                            <i class="fas fa-box"></i>
                            Others
                        </button>

                    </div>


                    {{-- Product Header --}}
                    <div class="product-heading">

                        <div>
                            <h5>Products</h5>
                            <small>24 products available</small>
                        </div>

                        <select class="sort-select">
                            <option>Popular</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                        </select>

                    </div>


                    {{-- ================= PRODUCTS ================= --}}
                    <div class="row p-3">

    @forelse ($productCards as $product)

        <div class="col-xl-3 col-lg-4 col-md-6 col-6 mb-4">

            <div class="product-card">

                {{-- Product Image --}}
                <div class="product-image">

                    @if ($product->avatar)
                        <img
                            src="{{ asset('storage/img/' . $product->avatar) }}"
                            alt="{{ $product->product_name_en }}"
                        >
                    @else
                        <img
                            src="{{ asset('storage/img/empty-img.png') }}"
                            alt="No Image"
                        >
                    @endif

                    {{-- Status --}}
                    @if ($product->disable)
                        <span class="stock bg-danger">
                            Disabled
                        </span>
                    @else
                        <span class="stock">
                            Available
                        </span>
                    @endif

                    {{-- Favorite
                    <button type="button" class="favorite">
                        <i class="far fa-heart"></i>
                    </button> --}}

                </div>


                {{-- Product Content --}}
                <div class="product-content">




                    {{-- Product Name --}}
                    <h6 class="font-weight-light">
                        {{ $product->product_name_en }}
                    </h6>


                    {{-- Bottom --}}
                    <div class="product-bottom">

                        <strong class="text-primary">
                            ${{ number_format($product->price, 2) }}
                        </strong>

                        <button
                            type="button"
                            class="add-product"
                            data-product-id="{{ $product->product_id }}"
                            title="Add Product"
                        >
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="text-center py-5">

                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>

                <h6 class="font-weight-bold text-muted">
                    No Products Found
                </h6>

                <small class="text-muted">
                    Start by adding your first product.
                </small>

            </div>

        </div>

    @endforelse

</div>
{{-- ================= PAGINATION ================= --}}
@if ($productCards->hasPages())
    <div class="d-flex justify-content-end mr-4">
        {{ $productCards->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endif

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- RIGHT : CHECKOUT --}}
            {{-- ===================================================== --}}
            <div class="col-xl-4 col-lg-5">

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


                    {{-- Customer --}}
                    <div class="customer-box">

                        <div class="customer-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="customer-info">
                            <strong>Walk-in Customer</strong>
                            <small>Default customer</small>
                        </div>

                        <button>
                            <i class="fas fa-chevron-down"></i>
                        </button>

                    </div>


                    {{-- Cart Items --}}
                    <div class="cart-list">


                        {{-- Cart Item --}}
                        <div class="cart-product">

                            <img
                                src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200"
                            >

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

                        </div>


                        {{-- Cart Item --}}
                        <div class="cart-product">

                            <img
                                src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200"
                            >

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

                        </div>


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
                                <input
                                    type="text"
                                    value="0"
                                >
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

            </div>

        </div>

    </div>


    <style>

    /* =========================================================
       GLOBAL
    ========================================================= */

    .sale-panel,
    .checkout-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid #edf0f5;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .04);
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .sale-number {
        background: #f0f6ff;
        color: #007bff;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
    }


    /* =========================================================
       TOOLBAR
    ========================================================= */

    .sale-toolbar {
        padding: 20px;
        display: flex;
        gap: 12px;
        border-bottom: 1px solid #f0f1f4;
    }

    .search-box {
        flex: 1;
        height: 45px;
        background: #f7f8fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        padding: 0 14px;
    }

    .search-box i {
        color: #9aa1ad;
        margin-right: 10px;
    }

    .search-box input {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 14px;
    }

    .shortcut {
        background: #e9ebef;
        padding: 3px 8px;
        border-radius: 5px;
        color: #777;
    }

    .filter-btn {
        border: 1px solid #e4e6eb;
        background: #fff;
        border-radius: 10px;
        padding: 0 18px;
        color: #555;
    }


    /* =========================================================
       CATEGORY
    ========================================================= */

    .category-list {
        display: flex;
        gap: 8px;
        padding: 16px 20px;
        overflow-x: auto;
    }

    .category {
        border: none;
        background: #f6f7f9;
        padding: 9px 15px;
        border-radius: 9px;
        color: #6c757d;
        white-space: nowrap;
        font-size: 13px;
    }

    .category i {
        margin-right: 5px;
    }

    .category.active {
        background: #007bff;
        color: white;
    }


    /* =========================================================
       PRODUCT HEADER
    ========================================================= */

    .product-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px 20px;
    }

    .product-heading h5 {
        font-weight: 700;
        margin-bottom: 3px;
    }

    .product-heading small {
        color: #999;
    }

    .sort-select {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 7px 12px;
        color: #666;
    }


    /* =========================================================
       PRODUCT CARD
    ========================================================= */

    .product-card {
        border: 1px solid #edf0f5;
        border-radius: 14px;
        overflow: hidden;
        background: white;
        transition: all .25s ease;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 123, 255, .12);
        border-color: #cfe2ff;
    }


    /* Product Image */

    .product-image {
        height: 150px;
        background: #f7f8fa;
        position: relative;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .3s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.07);
    }


    /* Stock */

    .stock {
        position: absolute;
        top: 9px;
        left: 9px;
        background: rgba(40, 167, 69, .9);
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
    }


    /* Favorite */

    .favorite {
        position: absolute;
        right: 9px;
        top: 9px;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 50%;
        background: white;
        color: #777;
    }


    /* Product Content */

    .product-content {
        padding: 12px;
    }

    .product-category {
        font-size: 10px;
        color: #007bff;
        text-transform: uppercase;
        font-weight: 700;
    }

    .product-content h6 {
        margin: 5px 0 12px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-bottom strong {
        font-size: 16px;
        color: #222;
    }

    .add-product {
        width: 31px;
        height: 31px;
        border: none;
        border-radius: 9px;
        background: #007bff;
        color: white;
        transition: .2s;
    }

    .add-product:hover {
        background: #0056b3;
        transform: scale(1.08);
    }


    /* =========================================================
       CHECKOUT
    ========================================================= */

    .checkout-card {
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .checkout-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f0f1f4;
    }

    .checkout-header h5 {
        font-weight: 700;
        margin-bottom: 4px;
    }

    .checkout-header small {
        color: #999;
    }

    .clear-btn {
        border: none;
        background: #fff1f1;
        color: #dc3545;
        padding: 7px 12px;
        border-radius: 8px;
    }


    /* =========================================================
       CUSTOMER
    ========================================================= */

    .customer-box {
        margin: 15px 20px;
        padding: 12px;
        background: #f7f9fc;
        border-radius: 12px;
        display: flex;
        align-items: center;
    }

    .customer-icon {
        width: 38px;
        height: 38px;
        background: #e6f0ff;
        color: #007bff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .customer-info {
        flex: 1;
        margin-left: 10px;
    }

    .customer-info strong {
        display: block;
        font-size: 13px;
    }

    .customer-info small {
        color: #999;
    }

    .customer-box button {
        border: none;
        background: none;
        color: #999;
    }


    /* =========================================================
       CART
    ========================================================= */

    .cart-list {
        padding: 0 20px;
        max-height: 300px;
        overflow-y: auto;
    }

    .cart-product {
        display: flex;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #f0f1f4;
    }

    .cart-product > img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 10px;
    }

    .cart-product-info {
        flex: 1;
        min-width: 0;
        margin-left: 10px;
    }

    .cart-product-info strong {
        display: block;
        font-size: 13px;
    }

    .cart-product-info small {
        color: #999;
        font-size: 11px;
    }


    /* Quantity */

    .quantity {
        display: flex;
        align-items: center;
        margin-top: 7px;
    }

    .quantity button {
        width: 23px;
        height: 23px;
        padding: 0;
        border: 1px solid #ddd;
        background: white;
        border-radius: 5px;
        font-size: 9px;
    }

    .quantity span {
        width: 28px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
    }


    /* Cart Price */

    .cart-price {
        text-align: right;
    }

    .cart-price strong {
        display: block;
        font-size: 13px;
    }

    .cart-price button {
        border: none;
        background: none;
        color: #dc3545;
        font-size: 11px;
        margin-top: 7px;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .summary {
        padding: 18px 20px 10px;
    }

    .summary > div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        color: #777;
        font-size: 13px;
    }

    .summary strong {
        color: #333;
    }

    .discount {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 7px;
        overflow: hidden;
    }

    .discount input {
        width: 55px;
        border: none;
        outline: none;
        text-align: right;
        padding: 5px;
    }

    .discount span {
        padding: 5px;
        background: #f5f5f5;
    }


    /* =========================================================
       TOTAL
    ========================================================= */

    .grand-total {
        margin: 5px 20px 18px;
        padding: 16px 0;
        border-top: 1px dashed #ddd;
        border-bottom: 1px dashed #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .grand-total span {
        font-size: 15px;
        font-weight: 600;
    }

    .grand-total strong {
        font-size: 25px;
        color: #007bff;
    }


    /* =========================================================
       PAYMENT
    ========================================================= */

    .payment-section {
        padding: 0 20px 18px;
    }

    .payment-section label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .payment-buttons {
        display: flex;
        gap: 8px;
    }

    .payment {
        flex: 1;
        padding: 10px 5px;
        background: white;
        border: 1px solid #e2e5ea;
        border-radius: 9px;
        color: #777;
    }

    .payment i {
        display: block;
        margin-bottom: 5px;
    }

    .payment span {
        font-size: 11px;
    }

    .payment.active {
        background: #eef5ff;
        border-color: #007bff;
        color: #007bff;
    }


    /* =========================================================
       CHECKOUT BUTTON
    ========================================================= */

    .checkout-btn {
        width: calc(100% - 40px);
        margin: 0 20px 20px;
        border: none;
        background: #007bff;
        color: white;
        padding: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        transition: .2s;
    }

    .checkout-btn:hover {
        background: #0056b3;
        box-shadow: 0 8px 20px rgba(0, 123, 255, .25);
    }

    .checkout-btn span {
        flex: 1;
        text-align: left;
    }

    .checkout-btn strong {
        font-size: 15px;
    }

    .checkout-btn i {
        font-size: 13px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media(max-width: 991px) {

        .checkout-card {
            position: relative;
            top: 0;
            margin-top: 20px;
        }

    }

    @media(max-width: 576px) {

        .sale-toolbar {
            flex-direction: column;
        }

        .filter-btn {
            height: 42px;
        }

        .product-image {
            height: 120px;
        }

        .product-heading {
            align-items: flex-start;
            gap: 10px;
        }

    }

    </style>

@endsection
