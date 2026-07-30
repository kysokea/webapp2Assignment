@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Create Product</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('product.edit', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Product Name KH -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Name (KH)</label>
                                <input type="text"
                                       name="product_name_kh"
                                       class="form-control"
                                       value="{{ $product->product_name_kh }}">

                                @error('product_name_kh')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Product Name EN -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Name (EN)</label>
                                <input type="text"
                                       name="product_name_en"
                                       class="form-control"
                                       value="{{ $product->product_name_en }}">

                                @error('product_name_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Price</label>
                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       step="0.01"
                                       value="{{ $product->price }}">

                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Category</label>

                                <select name="category_id" class="form-control">
                                    <option value="">-- Select Category --</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->category_title_en }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label>Status</label>

                        <div class="form-check">
                            <input type="hidden" name="disable" value="0">

                            <input type="checkbox"
                                name="disable"
                                id="disable"
                                value="1"
                                class="form-check-input"
                                {{ old('disable', $product->disable) ? 'checked' : '' }}>

                            <label for="disable" class="form-check-label">
                                Disable
                            </label>
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div class="text-center mb-3">
                        <label>Product Image</label>
                        <br>

                        <label for="avatar" style="cursor:pointer;">
                            <img id="preview-image"
                                src="{{ $product->avatar ? asset('/storage/img/' . $product->avatar) : asset('storage/img/empty-img.png') }}"
                                width="150" height="150" class="border rounded object-fit-cover">
                        </label>

                        <input type="file" id="avatar" name="avatar" hidden accept="image/*" onchange="previewImage(event)">

                        @error('avatar')
                            <br>
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary">
                            Save Product
                        </button>

                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            Back
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
    function previewImage(event) {
        const image = document.getElementById('preview-image');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
    </script>
@endsection
