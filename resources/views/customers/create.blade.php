@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="font-weight-bold mb-1">
                    <i class="fas fa-user-tag text-primary mr-2"></i>
                    Create Customer Type
                </h4>

                <small class="text-muted">
                    Add a new customer type to your system
                </small>
            </div>

            <a href="{{ route('customer.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-1"></i>
                Back
            </a>

        </div>


        {{-- Main Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex align-items-center">

                    <div class="bg-primary text-white rounded-circle
                            d-flex align-items-center justify-content-center mr-3" style="width:42px;height:42px;">

                        <i class="fas fa-plus"></i>

                    </div>

                    <div>

                        <h5 class="mb-0 font-weight-bold">
                            Customer Type Information
                        </h5>

                        <small class="text-muted">
                            Enter the customer type details below
                        </small>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <div class="card-body p-4">

                <form action="{{ route('customer.create') }}" method="POST">

                    @csrf


                    <div class="row">

                        {{-- Khmer --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="customer_type_kh" class="font-weight-bold">
                                    Customer Type (Khmer)
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-language text-primary"></i>
                                        </span>

                                    </div>

                                    <input type="text" name="customer_type_kh" id="customer_type_kh"
                                        class="form-control @error('customer_type_kh') is-invalid @enderror"
                                        value="{{ old('customer_type_kh') }}" placeholder="Enter customer type in Khmer">

                                </div>

                                @error('customer_type_kh')

                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>


                        {{-- English --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="customer_type_en" class="font-weight-bold">
                                    Customer Type (English)
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-font text-primary"></i>
                                        </span>

                                    </div>

                                    <input type="text" name="customer_type_en" id="customer_type_en"
                                        class="form-control @error('customer_type_en') is-invalid @enderror"
                                        value="{{ old('customer_type_en') }}" placeholder="Enter customer type in English">

                                </div>

                                @error('customer_type_en')

                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Divider --}}
                    <hr class="my-4">


                    {{-- Actions --}}
                    <div class="border-top pt-3">

                        <div class="d-flex justify-content-end">

                            <a href="{{ route('customer.index') }}" class="btn btn-light border mr-2">
                                <i class="fas fa-times mr-1"></i>
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i>
                                Save Customer Type
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
