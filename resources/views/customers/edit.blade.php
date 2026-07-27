{{-- @extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>Update Customer Type</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.edit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="customer_type_kh" class="form-label">
                            Customer Type (Khmer)
                        </label>
                        <input type="text" name="customer_type_kh" value="{{ $customer->customer_type_kh }}"
                            id="customer_type_kh" class="form-control @error('customer_type_kh') is-invalid @enderror"
                            value="{{ old('customer_type_kh') }}" placeholder="Enter customer type in Khmer">

                        @error('customer_type_kh')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_type_en" class="form-label">
                            Customer Type (English)
                        </label>
                        <input type="text" name="customer_type_en" value="{{ $customer->customer_type_en }}"
                            id="customer_type_en" class="form-control @error('customer_type_en') is-invalid @enderror"
                            value="{{ old('customer_type_en') }}" placeholder="Enter customer type in English">

                        @error('customer_type_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary me-2">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary ml-3">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection --}}
