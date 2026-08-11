@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="font-weight-bold mb-1">
                    <i class="fas fa-tags text-primary mr-2"></i>
                    Categories
                </h4>

                <small class="text-muted">
                    Manage product categories
                </small>
            </div>

            <a href="{{ route('category.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i>
                Add Category
            </a>

        </div>


        {{-- Main Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-list text-primary mr-2"></i>
                            Category List
                        </h5>

                        <small class="text-muted">
                            All categories in your system
                        </small>
                    </div>

                    <span class="badge badge-primary px-3 py-2">
                        {{ $categories->total() }} Categories
                    </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">

                            <tr class="text-muted">

                                <th class="text-center" width="70">
                                    #
                                </th>

                                <th>
                                    Category Khmer
                                </th>

                                <th>
                                    Category English
                                </th>

                                <th class="text-center" width="130">
                                    Status
                                </th>

                                <th class="text-center" width="130">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($categories as $key => $category)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center text-muted">
                                        {{ $categories->firstItem() + $key }}
                                    </td>


                                    {{-- Khmer --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="bg-primary text-white rounded-circle
                                                        d-flex align-items-center justify-content-center mr-3"
                                                style="width:40px;height:40px;">

                                                <i class="fas fa-language"></i>

                                            </div>

                                            <div>
                                                <div class="font-weight-bold text-dark">
                                                    {{ $category->category_title_kh }}
                                                </div>

                                                <small class="text-muted">
                                                    Khmer
                                                </small>
                                            </div>

                                        </div>

                                    </td>


                                    {{-- English --}}
                                    <td>

                                        <div class="font-weight-bold text-dark">
                                            {{ $category->category_title_en }}
                                        </div>

                                        <small class="text-muted">
                                            English
                                        </small>

                                    </td>


                                    {{-- Status --}}
                                    <td class="text-center">

                                        @if ($category->disable == 1)

                                            <span class="badge badge-danger px-3 py-2">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                Disabled
                                            </span>

                                        @else

                                            <span class="badge badge-success px-3 py-2">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Active
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-center">

                                        <a href="{{ route('category.edit', $category->category_id) }}"
                                            class="btn btn-outline-warning btn-sm" title="Edit Category">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fas fa-tags fa-3x mb-3"></i>

                                            <h6 class="font-weight-bold">
                                                No Categories Found
                                            </h6>

                                            <small>
                                                Start by adding your first category.
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
                        <strong>{{ $categories->firstItem() ?? 0 }}</strong>
                        to
                        <strong>{{ $categories->lastItem() ?? 0 }}</strong>
                        of
                        <strong>{{ $categories->total() }}</strong>
                        categories

                    </small>

                    {{-- Your pagination --}}
                    <div>
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
