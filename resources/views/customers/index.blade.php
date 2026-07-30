@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Customers
            </div>

            <div class="card-tools">
                <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Add Customer
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center align-middle">
                            <th width="80">Customer Type Khmer</th>
                            <th width="80">Customer Type English</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="text-center align-middle">
                                <td class="text-center align-middle">{{ $customer->customer_type_kh }}</td>
                                <td class="text-center align-middle">{{ $customer->customer_type_en }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('customers.edit', $customer->customer_id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('customer.drop', $customer->customer_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this customer type?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
