@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Users
            </div>

            <div class="card-tools">
                <a href="#" class="btn btn-primary btn-sm">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th width="150">Phone</th>
                            <th width="120">Role</th>
                            <th width="100">Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="text-center align-middle">
                            <td>
                                <img src="https://placehold.co/50x50" class="rounded-circle" width="50" height="50"
                                    alt="Avatar">
                            </td>
                            <td class="text-center align-middle">John Doe</td>
                            <td class="text-center align-middle">john@example.com</td>
                            <td class="text-center align-middle">012345678</td>
                            <td class="text-center align-middle">
                                <span class="badge bg-primary">Admin</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge bg-success">Active</span>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="text-center align-middle">
                            <td>
                                <img src="https://placehold.co/50x50" class="rounded-circle" width="50" height="50"
                                    alt="Avatar">
                            </td>
                            <td class="text-center align-middle">John Doe</td>
                            <td class="text-center align-middle">john@example.com</td>
                            <td class="text-center align-middle">012345678</td>
                            <td class="text-center align-middle">
                                <span class="badge bg-primary">Admin</span>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge bg-success">Active</span>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
