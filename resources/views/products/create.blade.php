@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="font-weight-bold mb-1">
                <i class="fas fa-box-open text-primary mr-2"></i>
                Create Product
            </h4>

            <small class="text-muted">
                Add a new product to your inventory
            </small>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
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
                            d-flex align-items-center justify-content-center mr-3"
                    style="width:42px;height:42px;">

                    <i class="fas fa-plus"></i>

                </div>

                <div>
                    <h5 class="mb-0 font-weight-bold">
                        Product Information
                    </h5>

                    <small class="text-muted">
                        Fill in the details below to create a product
                    </small>
                </div>

            </div>

        </div>


        {{-- Form --}}
        <div class="card-body p-4">

            <form action="{{ route('product.create') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- Product Names --}}
                <div class="row">

                    {{-- Khmer Name --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">
                                Product Name (KH)
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-language text-primary"></i>
                                    </span>
                                </div>

                                <input
                                    type="text"
                                    name="product_name_kh"
                                    class="form-control @error('product_name_kh') is-invalid @enderror"
                                    value="{{ old('product_name_kh') }}"
                                    placeholder="Enter Khmer product name"
                                >

                            </div>

                            @error('product_name_kh')
                                <small class="text-danger">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>


                    {{-- English Name --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">
                                Product Name (EN)
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-font text-primary"></i>
                                    </span>
                                </div>

                                <input
                                    type="text"
                                    name="product_name_en"
                                    class="form-control @error('product_name_en') is-invalid @enderror"
                                    value="{{ old('product_name_en') }}"
                                    placeholder="Enter English product name"
                                >

                            </div>

                            @error('product_name_en')
                                <small class="text-danger">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Price + Category --}}
                <div class="row">

                    {{-- Price --}}
                    <div class="col-md-6">
                        <div class="form-group">

                            <label class="font-weight-bold">
                                Price
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-dollar-sign text-success"></i>
                                    </span>
                                </div>

                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" placeholder="Enter price" min="0" step="0.01" required>

                                <div class="input-group-append">
                                    <span class="input-group-text bg-light">
                                        USD
                                    </span>
                                </div>

                            </div>

                            @error('price')
                                <small class="text-danger">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </small>
                            @enderror

                            <small class="text-muted">
                                Enter the product price, e.g. 10.50
                            </small>

                        </div>
                    </div>


                    {{-- Category --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">
                                Category
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-tags text-primary"></i>
                                    </span>
                                </div>

                                <select
                                    name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror"
                                >

                                    <option value="">
                                        -- Select Category --
                                    </option>

                                    @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->category_id }}"
                                            {{ old('category_id') == $category->category_id ? 'selected' : '' }}
                                        >
                                            {{ $category->category_title_en }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            @error('category_id')
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


                <div class="row">

                    {{-- Status --}}
                    <div class="col-md-6">

                        <label class="font-weight-bold d-block">
                            Product Status
                        </label>

                        <div class="card bg-light border-0">

                            <div class="card-body py-3">

                                <input type="hidden" name="disable" value="0">

                                <div class="custom-control custom-switch">

                                    <input
                                        type="checkbox"
                                        name="disable"
                                        id="disable"
                                        value="1"
                                        class="custom-control-input"
                                        {{ old('disable') ? 'checked' : '' }}
                                    >

                                    <label
                                        for="disable"
                                        class="custom-control-label"
                                    >
                                        <span class="font-weight-bold">
                                            Disable Product
                                        </span>

                                        <small class="d-block text-muted">
                                            Disabled products won't be available
                                        </small>
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Image Upload --}}
                    <div class="col-md-6">

                        <label class="font-weight-bold">
                            Product Image
                        </label>

                        <div class="card bg-light border-0">

                            <div class="card-body text-center py-3">

                                <label
                                    for="avatar"
                                    class="mb-2"
                                    style="cursor:pointer;"
                                >

                                    <img
                                        id="preview-image"
                                        src="/storage/img/empty-img.png"
                                        width="120"
                                        height="120"
                                        class="rounded border shadow-sm"
                                        style="object-fit:cover;"
                                        alt="Product preview"
                                    >

                                </label>

                                <div>
                                    <label
                                        for="avatar"
                                        class="btn btn-outline-primary btn-sm"
                                    >
                                        <i class="fas fa-cloud-upload-alt mr-1"></i>
                                        Choose Image
                                    </label>
                                </div>

                                <small class="text-muted d-block mt-2">
                                    JPG, JPEG, PNG up to your allowed file size
                                </small>

                                <input
                                    type="file"
                                    id="avatar"
                                    name="avatar"
                                    hidden
                                    accept="image/*"
                                    onchange="previewImage(event)"
                                >

                                @error('avatar')

                                    <small class="text-danger d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Form Actions --}}
                <div class="border-top mt-4 pt-3">

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('products.index') }}"
                            class="btn btn-light border mr-2"
                        >
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            <i class="fas fa-save mr-1"></i>
                            Save Product
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    </div>

    {{-- Image Preview --}}

    <script>

    function previewImage(event) {

        const image = document.getElementById('preview-image');

        if (event.target.files && event.target.files[0]) {

            image.src = URL.createObjectURL(event.target.files[0]);

        }

    }

    </script>

@endsection
