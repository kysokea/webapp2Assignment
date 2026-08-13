{{-- <div class="col-xl-8 col-lg-7"> --}}

    <div class="sale-panel">

        {{-- Search --}}
        <div class="sale-toolbar">

            <div class="search-box">

                <i class="fas fa-search"></i>

                <input type="text" placeholder="Search product...">

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

                    <a {{-- href="{{ route('sales.add', $product->product_id) }}" --}}
                        href="{{ route('action.selectedProduct', $product->product_id) }}"
                        class="product-card d-block text-decoration-none">

                        {{-- Product Image --}}
                        <div class="product-image">

                            @if ($product->avatar)
                                <img src="{{ asset('storage/img/' . $product->avatar) }}" alt="{{ $product->product_name_en }}">
                            @else
                                <img src="{{ asset('storage/img/empty-img.png') }}" alt="No Image">
                            @endif

                            {{-- Status --}}
                            <span class="stock">
                                Available
                            </span>

                        </div>


                        {{-- Product Content --}}
                        <div class="product-content">

                            {{-- Product Name --}}
                            <h6 class="font-weight-light text-dark">
                                {{ $product->product_name_en }}
                            </h6>


                            <div class="product-bottom">

                                <strong class="text-primary">
                                    ${{ number_format($product->price, 2) }}
                                </strong>

                                <span class="add-product d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plus"></i>
                                </span>

                            </div>

                        </div>

                    </a>

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


        {{-- Pagination --}}
        {{-- @if ($productCards->hasPages())

            <div class="d-flex justify-content-end mr-4">

                {{ $productCards->onEachSide(1)->links('pagination::bootstrap-5') }}

            </div>

        @endif --}}
        <div class="card-footer">
            {{ $productCards->links() }}
        </div>

    </div>

{{-- </div> --}}
