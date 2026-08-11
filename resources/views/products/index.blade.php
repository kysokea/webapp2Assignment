@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="font-weight-bold mb-1">
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


        {{-- Product Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-list text-primary mr-2"></i>
                            Product List
                        </h5>

                        <small class="text-muted">
                            All products in your system
                        </small>
                    </div>

                    <span class="badge badge-primary px-3 py-2">
                        {{ $products->total() }} Products
                    </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">

                            <tr class="text-muted">

                                <th class="text-center" width="80">
                                    #
                                </th>

                                <th class="text-center" width="100">
                                    Image
                                </th>

                                <th>
                                    Name Khmer
                                </th>

                                <th>
                                    Name English
                                </th>

                                <th class="text-center" width="150">
                                    Price
                                </th>

                                <th class="text-center" width="120">
                                    Status
                                </th>

                                <th class="text-center" width="130">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($products as $index => $product)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center text-muted">
                                        {{ $products->firstItem() + $index }}
                                    </td>


                                    {{-- Image --}}
                                    <td class="text-center">

                                        @if ($product->avatar)

                                            <img src="{{ asset('/storage/img/' . $product->avatar) }}" width="52" height="52"
                                                class="rounded-circle border shadow-sm" style="object-fit: cover;"
                                                alt="{{ $product->product_name_en }}">

                                        @else

                                            <div class="d-inline-flex align-items-center justify-content-center
                                                                bg-light border rounded-circle text-muted"
                                                style="width:52px;height:52px;">

                                                <i class="fas fa-image"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- Khmer Name --}}
                                    <td>

                                        <div class="font-weight-bold text-dark">
                                            {{ $product->product_name_kh }}
                                        </div>

                                    </td>


                                    {{-- English Name --}}
                                    <td>

                                        <div class="font-weight-bold text-dark">
                                            {{ $product->product_name_en }}
                                        </div>

                                    </td>


                                    {{-- Price --}}
                                    <td class="text-center">

                                        <span class="badge badge-light border px-3 py-2">
                                            <i class="fas fa-dollar-sign text-success mr-1"></i>
                                            <span class="text-success font-weight-bold">
                                                {{ number_format($product->price, 2) }}
                                            </span>
                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td class="text-center">

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
                                    <td class="text-center">

                                        <a href="{{ route('product.edit', $product->product_id) }}"
                                            class="btn btn-outline-warning btn-sm" title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>

                                        <h6 class="font-weight-bold text-muted">
                                            No Products Found
                                        </h6>

                                        <small class="text-muted">
                                            Start by adding your first product.
                                        </small>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Pagination --}}
            <div class="card-footer bg-white">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <small class="text-muted mb-2 mb-md-0">
                        Showing
                        <strong>{{ $products->firstItem() ?? 0 }}</strong>
                        to
                        <strong>{{ $products->lastItem() ?? 0 }}</strong>
                        of
                        <strong>{{ $products->total() }}</strong>
                        products
                    </small>

                    {{-- YOUR PAGINATION --}}
                    <div>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
