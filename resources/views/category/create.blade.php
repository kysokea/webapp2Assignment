@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>Create Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.create') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="category_title_kh" class="form-label">
                            Category Title (Khmer)
                        </label>
                        <input type="text" name="category_title_kh" id="category_title_kh"
                            class="form-control @error('category_title_kh') is-invalid @enderror"
                            value="{{ old('category_title_kh') }}" placeholder="Enter category title in Khmer">

                        @error('category_title_kh')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_title_en" class="form-label">
                            Category Title (English)
                        </label>
                        <input type="text" name="category_title_en" id="category_title_en"
                            class="form-control @error('category_title_en') is-invalid @enderror"
                            value="{{ old('category_title_en') }}" placeholder="Enter category title in English">

                        @error('category_title_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3 w-50">
                        <label>Status</label>

                        <div class="form-check">
                            <input type="hidden" name="disable" value="0">

                            <input type="checkbox" class="form-check-input" id="disable" name="disable" value="1"
                                {{ old('disable') ? 'checked' : '' }}>

                            <label class="form-check-label" for="disable">
                                Disabled
                            </label>
                        </div>

                        @error('disable')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">
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
@endsection
