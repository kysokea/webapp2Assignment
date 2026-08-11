@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="font-weight-bold mb-1">
                    <i class="fas fa-edit text-warning mr-2"></i>
                    Edit Category
                </h4>

                <small class="text-muted">
                    Update category information and settings
                </small>
            </div>

            <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-1"></i>
                Back
            </a>

        </div>


        {{-- Main Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex align-items-center">

                    <div class="bg-warning text-white rounded-circle
                            d-flex align-items-center justify-content-center mr-3" style="width:42px;height:42px;">

                        <i class="fas fa-edit"></i>

                    </div>

                    <div>
                        <h5 class="mb-0 font-weight-bold">
                            Category Information
                        </h5>

                        <small class="text-muted">
                            Update the category details below
                        </small>
                    </div>

                </div>

            </div>


            {{-- Form --}}
            <div class="card-body p-4">

                <form action="{{ route('category.edit', $category->category_id) }}" method="POST">

                    @csrf


                    {{-- Category Names --}}
                    <div class="row">

                        {{-- Khmer --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="category_title_kh" class="font-weight-bold">
                                    Category Title (Khmer)
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-language text-primary"></i>
                                        </span>
                                    </div>

                                    <input type="text" name="category_title_kh" id="category_title_kh"
                                        class="form-control @error('category_title_kh') is-invalid @enderror"
                                        value="{{ old('category_title_kh', $category->category_title_kh) }}"
                                        placeholder="Enter category title in Khmer">

                                </div>

                                @error('category_title_kh')

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

                                <label for="category_title_en" class="font-weight-bold">
                                    Category Title (English)
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-font text-primary"></i>
                                        </span>
                                    </div>

                                    <input type="text" name="category_title_en" id="category_title_en"
                                        class="form-control @error('category_title_en') is-invalid @enderror"
                                        value="{{ old('category_title_en', $category->category_title_en) }}"
                                        placeholder="Enter category title in English">

                                </div>

                                @error('category_title_en')

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


                    {{-- Status --}}
                    <div class="row">

                        <div class="col-md-6">

                            <label class="font-weight-bold d-block">
                                Category Status
                            </label>

                            <div class="card bg-light border-0">

                                <div class="card-body py-3">

                                    <input type="hidden" name="disable" value="0">

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="disable" name="disable"
                                            value="1" {{ old('disable', $category->disable) == 1 ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="disable">

                                            <span class="font-weight-bold">
                                                Disable Category
                                            </span>

                                            <small class="d-block text-muted">
                                                Disabled categories won't be available
                                            </small>

                                        </label>

                                    </div>

                                </div>

                            </div>

                            @error('disable')

                                <small class="text-danger">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="border-top mt-4 pt-3">

                        <div class="d-flex justify-content-end">

                            <a href="{{ route('category.index') }}" class="btn btn-light border mr-2">
                                <i class="fas fa-times mr-1"></i>
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save mr-1"></i>
                                Update Category
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
