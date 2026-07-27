@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Users
            </div>

            <div class="card-tools">
                {{-- <a href="#" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Add User
                </a> --}}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center align-middle">
                            <th width="80">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="150">Phone</th>
                            <th width="120">Role</th>
                            <th width="100">Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center align-middle">
                                <td>

                                    @if ($user->avatar)
                                        <img src="{{ asset('/storage/img/' . $user->avatar) }}" width="50"
                                            height="50" class="rounded-circle object-fit-cover">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="text-center align-middle">{{ $user->name }}</td>
                                <td class="text-center align-middle">{{ $user->email }}</td>
                                <td class="text-center align-middle">{{ $user->phone }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-primary">{{ $user->role }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    @if ($user->disable)
                                        <span class="badge bg-danger">Disabled</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>

                                <td class="text-center align-middle">
                                    <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-warning btn-sm">
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
            </div>
        </div>
    </div>
@endsection
