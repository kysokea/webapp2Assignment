@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="font-weight-bold mb-1">
                    <i class="fas fa-users text-primary mr-2"></i>
                    Customers
                </h4>

                <small class="text-muted">
                    Manage customer types
                </small>
            </div>

            <a href="{{ route('customer.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i>
                Add Customer
            </a>

        </div>


        {{-- Main Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-user-tag text-primary mr-2"></i>
                            Customer Type List
                        </h5>

                        <small class="text-muted">
                            All customer types in your system
                        </small>
                    </div>

                    <span class="badge badge-primary px-3 py-2">
                        {{ $customers->total() }} Types
                    </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">

                            <tr class="text-muted ">

                                <th class="text-center " width="70">
                                    #
                                </th>

                                <th class="text-center">
                                    Customer Type Khmer
                                </th>

                                <th class="text-center">
                                    Customer Type English
                                </th>

                                <th class="text-center" width="150">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($customers as $key => $customer)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center text-muted align-middle">
                                        {{ $customers->firstItem() + $key }}
                                    </td>


                                    {{-- Khmer --}}
                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <div class="bg-primary text-white rounded-circle
                                                        d-flex align-items-center justify-content-center mr-3"
                                                style="width:40px;height:40px;">

                                                <i class="fas fa-language"></i>

                                            </div>

                                            <div>

                                                <div class="font-weight-bold text-dark text-center">
                                                    {{ $customer->customer_type_kh }}
                                                </div>

                                                <small class="text-muted">
                                                    Khmer
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- English --}}
                                    <td class="d-flex justify-content-center flex-column align-items-center">
                                        <div>
                                            <div class="font-weight-bold text-dark ">
                                                {{ $customer->customer_type_en }}
                                            </div>

                                            <small class="text-muted ">
                                                English
                                            </small>
                                        </div>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="text-center align-middle">

                                        {{-- Edit --}}
                                        <a href="{{ route('customers.edit', $customer->customer_id) }}"
                                            class="btn btn-outline-warning btn-sm" title="Edit Customer">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('customer.drop', $customer->customer_id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Customer"
                                                onclick="return confirm('Are you sure you want to delete this customer type?')">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fas fa-users-slash fa-3x mb-3"></i>

                                            <h6 class="font-weight-bold">
                                                No Customer Types Found
                                            </h6>

                                            <small>
                                                Start by adding your first customer type.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Footer + Pagination --}}
            <div class="card-footer bg-white">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <small class="text-muted mb-2 mb-md-0">

                        Showing
                        <strong>{{ $customers->firstItem() ?? 0 }}</strong>
                        to
                        <strong>{{ $customers->lastItem() ?? 0 }}</strong>
                        of
                        <strong>{{ $customers->total() }}</strong>
                        customer types

                    </small>

                    <div>
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
