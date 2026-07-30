@extends('layouts.admin')

@section('content')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Category
            </h3>
            <div class="card-tools">
                <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Add Category
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="50">No</th>
                            <th>Category Khmer</th>
                            <th>Category English</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            <tr class="text-center">
                                <td>
                                    {{ $categories->firstItem() + $key }}
                                </td>
                                <td>
                                    {{ $category->category_title_kh }}
                                </td>
                                <td>
                                    {{ $category->category_title_en }}
                                </td>
                                <td>
                                    @if ($category->disable == 1)
                                        <span class="badge bg-danger">
                                            Disabled
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit -->
                                    <a href="{{ route('category.edit',$category->category_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No Category Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination -->
                {{-- <div class="d-flex justify-content-end"> --}}
                    {{ $categories->links('pagination::bootstrap-5') }}
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
