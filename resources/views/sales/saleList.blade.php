@extends('layouts.admin')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-receipt mr-2"></i>
                Sale List
            </h3>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Sale ID</th>
                            <th>Customer</th>
                            <th>User</th>
                            <th>Payment</th>
                            <th>Sale Date</th>
                            <th>Subtotal ($)</th>
                            <th>Discount ($)</th>
                            <th>Grand Total ($)</th>
                            <th>Cash Receive</th>
                            <th>Cash Return</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($saleList as $sale)
                            <tr>
                                <td>
                                    {{ $saleList->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>#{{ $sale->sale_id }}</strong>
                                </td>

                                <td>
                                    {{ $sale->customer_id ?? 'Walk-in Customer' }}
                                </td>

                                <td>
                                    {{ $sale->user_id }}
                                </td>

                                <td>
                                    {{ $sale->payment_id }}
                                </td>

                                <td>
                                    {{ $sale->sale_date }}
                                </td>

                                <td>
                                    ${{ number_format($sale->sub_total_dollar, 2) }}
                                </td>

                                <td>
                                    ${{ number_format($sale->discount ?? 0, 2) }}
                                </td>

                                <td>
                                    <strong>
                                        ${{ number_format($sale->grand_total_dollar, 2) }}
                                    </strong>
                                </td>

                                <td>
                                    {{ number_format($sale->cash_receive, 2) }}
                                </td>

                                <td>
                                    {{ number_format($sale->cash_return, 2) }}
                                </td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-4">
                                    <i class="fas fa-receipt fa-2x text-muted mb-2"></i>
                                    <p class="mb-0 text-muted">
                                        No sales found.
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
            {{ $saleList->links() }}
        </div>
    </div>
@endsection
