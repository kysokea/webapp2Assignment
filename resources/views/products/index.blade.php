@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Users
            </div>

            <div class="card-tools">
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Add User
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center align-middle">
                            <th width="80">Avatar</th>
                            <th>Name Khmer</th>
                            <th>Name English</th>
                            <th width="150">Price</th>
                            {{-- <th width="120">Role</th> --}}
                            <th width="100">Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr class="text-center align-middle">
                                <td>

                                    @if ($product->avatar)
                                        <img src="{{ asset('/storage/img/' . $product->avatar) }}" width="50" height="50"
                                            class="rounded-circle object-fit-cover">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="text-center align-middle">{{ $product->product_name_kh }}</td>
                                <td class="text-center align-middle">{{ $product->product_name_en }}</td>
                                <td class="text-center align-middle text-success">{{ $product->price }} $</td>

                                <td class="text-center align-middle">
                                    @if ($product->disable)
                                        <span class="badge bg-danger ">Disabled</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>

                                <td class="text-center align-middle">
                                    <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
