@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="mb-1">
                    <i class="fas fa-box-open text-primary mr-2"></i>
                    Sale Detail List
                </h3>

                <p class="text-muted mb-0">
                    View all products sold in each sale.
                </p>
            </div>

            {{-- <div>
                <a href="{{ route('sale1.saleDetailList') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Sale List

                </a>
            </div> --}}

        </div>


        {{-- =========================================================
            TABLE CARD
        ========================================================== --}}
        <div class="card shadow-sm border-0">

            {{-- Header --}}
            <div class="card-header bg-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">

                        <i class="fas fa-list text-primary mr-2"></i>

                        Sale Details

                    </h5>

                    <span class="badge badge-primary">

                        {{ $saleDetailLists->total() }} Items

                    </span>

                </div>

            </div>


            {{-- =====================================================
                TABLE
            ====================================================== --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered mb-0">

                        {{-- TABLE HEADER --}}
                        <thead class="thead-light">

                            <tr>

                                <th width="60">
                                    #
                                </th>

                                <th>
                                    Detail ID
                                </th>

                                <th>
                                    Sale ID
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Product KH
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Total
                                </th>

                                <th width="100">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        {{-- =================================================
                            TABLE BODY
                        ================================================== --}}
                        <tbody>

                            @forelse ($saleDetailLists as $detail)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td class="text-center align-middle">

                                        {{ $saleDetailLists->firstItem() + $loop->index }}

                                    </td>


                                    {{-- DETAIL ID --}}
                                    <td class="align-middle">

                                        <span class="badge badge-secondary">

                                            #{{ $detail->saleDetail_id }}

                                        </span>

                                    </td>


                                    {{-- SALE ID --}}
                                    <td class="align-middle">

                                        <a href="#">

                                            <span class="badge badge-primary">

                                                #{{ $detail->sale_id }}

                                            </span>

                                        </a>

                                    </td>


                                    {{-- PRODUCT --}}
                                    <td class="align-middle">

                                        <div class="d-flex align-items-center">

                                            {{-- IMAGE --}}
                                            <div class="mr-3">

                                                @if ($detail->avatar)

                                                    <img
                                                        src="{{ asset('storage/img/' . $detail->avatar) }}"
                                                        width="55"
                                                        height="55"
                                                        class="rounded border"
                                                        style="object-fit: cover;"
                                                        alt="{{ $detail->product_name_en }}"
                                                    >

                                                @else

                                                    <div
                                                        class="rounded border bg-light d-flex align-items-center justify-content-center"
                                                        style="width:55px;height:55px;"
                                                    >

                                                        <i class="fas fa-image text-muted"></i>

                                                    </div>

                                                @endif

                                            </div>


                                            {{-- PRODUCT NAME --}}
                                            <div>

                                                <strong class="d-block">

                                                    {{ $detail->product_name_en }}

                                                </strong>

                                                <small class="text-muted">

                                                    Product ID:
                                                    {{ $detail->product_id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- KHMER NAME --}}
                                    <td class="align-middle">

                                        {{ $detail->product_name_kh }}

                                    </td>


                                    {{-- QUANTITY --}}
                                    <td class="align-middle text-center">

                                        <span class="badge badge-info">

                                            {{ $detail->qty }}

                                        </span>

                                    </td>


                                    {{-- PRICE --}}
                                    <td class="align-middle">

                                        ${{ number_format($detail->price ?? 0, 2) }}

                                    </td>


                                    {{-- TOTAL --}}
                                    <td class="align-middle">

                                        <strong class="text-success">

                                            ${{ number_format(($detail->qty ?? 0) * ($detail->price ?? 0), 2) }}

                                        </strong>

                                    </td>


                                    {{-- ACTION --}}
                                    <td class="align-middle text-center">

                                        <div class="btn-group">

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-info"
                                                title="View"
                                            >

                                                <i class="fas fa-eye"></i>

                                            </button>


                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger ml-1"
                                                title="Delete"
                                            >

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- EMPTY --}}
                                <tr>

                                    <td
                                        colspan="9"
                                        class="text-center py-5"
                                    >

                                        <i
                                            class="fas fa-box-open fa-3x text-muted mb-3"
                                        ></i>

                                        <h5 class="text-muted">

                                            No Sale Details Found

                                        </h5>

                                        <p class="text-muted mb-0">

                                            There are no sale details available.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Pagination --}}
            <div class="card-footer">
                {{ $saleDetailLists->links() }}
            </div>

        </div>

    </div>

@endsection
