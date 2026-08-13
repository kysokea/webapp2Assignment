@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- =====================================================
        PAGE HEADER
        ====================================================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-box-open text-primary mr-2"></i>
                    Products
                </h4>

                <small class="text-muted">
                    Manage your products and inventory
                </small>
            </div>

            <a href="{{ route('product.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i>
                Add Product
            </a>

        </div>


        {{-- =====================================================
        PRODUCT CARD
        ====================================================== --}}
        <div class="card card-outline card-primary shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">
                            <i class="fas fa-list text-primary mr-2"></i>
                            Product List
                        </h5>

                        <small class="text-muted">
                            All products in your system
                        </small>
                    </div>

                    <span class="badge badge-primary px-3 py-2">
                        <i class="fas fa-box mr-1"></i>
                        {{ $products->total() }} Products
                    </span>

                </div>

            </div>


            {{-- =================================================
            TABLE
            ================================================== --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-striped mb-0">

                        <thead class="thead-light">

                            <tr>

                                <th class="text-center align-middle" width="70">
                                    #
                                </th>

                                <th class="text-center align-middle" width="100">
                                    Image
                                </th>

                                <th class="align-middle">
                                    Name Khmer
                                </th>

                                <th class="align-middle">
                                    Name English
                                </th>

                                <th class="text-center align-middle" width="150">
                                    Price
                                </th>

                                <th class="text-center align-middle" width="130">
                                    Status
                                </th>

                                <th class="text-center align-middle" width="120">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($products as $index => $product)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center align-middle text-muted">
                                        {{ $products->firstItem() + $index }}
                                    </td>


                                    {{-- Image --}}
                                    <td class="text-center align-middle">

                                        @if ($product->avatar)

                                            <img src="{{ asset('/storage/img/' . $product->avatar) }}" width="55" height="55"
                                                class="rounded-circle img-thumbnail" style="object-fit: cover;"
                                                alt="{{ $product->product_name_en }}">

                                        @else

                                            <span class="d-inline-flex
                                                                 align-items-center
                                                                 justify-content-center
                                                                 bg-light
                                                                 border
                                                                 rounded-circle
                                                                 text-muted" style="width:55px;height:55px;">

                                                <i class="fas fa-image"></i>

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Khmer --}}
                                    <td class="align-middle">

                                        <span class="text-secondary font-weight-normal">
                                            {{ $product->product_name_kh }}
                                        </span>

                                    </td>


                                    {{-- English --}}
                                    <td class="align-middle">

                                        <span class="text-secondary font-weight-normal">
                                            {{ $product->product_name_en }}
                                        </span>

                                    </td>


                                    {{-- Price --}}
                                    <td class="text-center align-middle">

                                        <span class="badge badge-light border px-3 py-2">

                                            <i class="fas fa-dollar-sign
                                                          text-success mr-1"></i>

                                            <span class="text-success font-weight-bold">
                                                {{ number_format($product->price, 2) }}
                                            </span>

                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td class="text-center align-middle">

                                        @if ($product->disable)

                                            <span class="badge badge-danger px-3 py-2">

                                                <i class="fas fa-times-circle mr-1"></i>

                                                Disabled

                                            </span>

                                        @else

                                            <span class="badge badge-success px-3 py-2">

                                                <i class="fas fa-check-circle mr-1"></i>

                                                Active

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-center align-middle">

                                        <a href="{{ route('product.edit', $product->product_id) }}"
                                            class="btn btn-outline-warning btn-sm" title="Edit Product">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fas fa-box-open fa-3x mb-3"></i>

                                            <h6 class="font-weight-bold">
                                                No Products Found
                                            </h6>

                                            <p class="mb-3">
                                                Start by adding your first product.
                                            </p>

                                            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">

                                                <i class="fas fa-plus mr-1"></i>

                                                Add Product

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =================================================
            PAGINATION
            ================================================== --}}
            <div class="card-footer">
                {{ $products->links() }}
            </div>

        </div>

    </div>

@endsection
