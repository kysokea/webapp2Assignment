@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- =====================================================
        PAGE HEADER
        ====================================================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="font-weight-bold text-dark mb-1">
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


        {{-- =====================================================
        MAIN CARD
        ====================================================== --}}
        <div class="card card-outline card-primary shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="font-weight-bold text-dark mb-1">

                            <i class="fas fa-user-tag text-primary mr-2"></i>

                            Customer Type List

                        </h5>

                        <small class="text-muted">
                            All customer types in your system
                        </small>

                    </div>


                    <span class="badge badge-primary px-3 py-2">

                        <i class="fas fa-users mr-1"></i>

                        {{ $customers->total() }} Types

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

                                <th class="text-center align-middle">
                                    Customer Type Khmer
                                </th>

                                <th class="text-center align-middle">
                                    Customer Type English
                                </th>

                                <th class="text-center align-middle" width="150">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($customers as $key => $customer)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center align-middle text-muted">

                                        {{ $customers->firstItem() + $key }}

                                    </td>


                                    {{-- Khmer --}}
                                    <td class="align-middle">

                                        <div class="d-flex align-items-center justify-content-center">

                                            <div class="bg-primary text-white rounded-circle
                                                            d-flex align-items-center justify-content-center mr-3"
                                                style="width:40px;height:40px;">

                                                <i class="fas fa-language"></i>

                                            </div>

                                            <div class="text-left">

                                                <div class="text-secondary font-weight-normal">

                                                    {{ $customer->customer_type_kh }}

                                                </div>

                                                <small class="text-muted">

                                                    Khmer

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- English --}}
                                    <td class="text-center align-middle">

                                        <div>

                                            <div class="text-secondary font-weight-normal">

                                                {{ $customer->customer_type_en }}

                                            </div>

                                            <small class="text-muted">

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

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="4" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fas fa-users-slash fa-3x mb-3"></i>

                                            <h6 class="font-weight-bold text-dark">

                                                No Customer Types Found

                                            </h6>

                                            <p class="small mb-3">

                                                Start by adding your first customer type.

                                            </p>

                                            <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm">

                                                <i class="fas fa-plus mr-1"></i>

                                                Add Customer Type

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
            <div class="card-footer">
                {{ $customers->links() }}
            </div>

        </div>

    </div>

@endsection
