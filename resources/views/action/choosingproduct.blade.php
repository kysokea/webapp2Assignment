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


                {{-- LEFT SIDE --}}
                <div class="col-xl-8 col-lg-7">

                    @include('action.components.product-list', [
        'productCards' => $productCards
    ])

                </div>




                {{-- RIGHT SIDE --}}
                <div class="col-xl-4 col-lg-5">

                    @include('action.components.sale-cart', [
        'cartProducts' => $cartProducts ?? []
    ])

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

            .cart-product>img {
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

            .summary>div {
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
