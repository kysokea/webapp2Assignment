@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="fas fa-users text-primary me-2"></i>
                    Users
                </h4>

                <small class="text-muted">
                    Manage system users and their information
                </small>
            </div>

            <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ $users->count() }} Users
            </span>
            {{-- <a href="{{ route('user.create') }}" class="btn btn-primary"> <i class="fas fa-plus me-1"></i> Add User </a> --}}

        </div>


        {{-- User Card --}}
        <div class="card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-friends text-primary me-2"></i>
                            User Management
                        </h5>
                    </div>

                    {{-- Search --}}
                    <div class="input-group" style="max-width: 280px;">


                        <input type="text" id="userSearch" class="form-control" placeholder="Search users...">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>

                    </div>

                </div>

            </div>


            {{-- Table --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0" id="usersTable">

                        <thead class="table-light">

                            <tr class="text-muted">

                                <th class="text-center" width="80">
                                    #
                                </th>

                                <th class="text-center">
                                    Picture
                                </th>
                                <th class="text-center">
                                    Username
                                </th>

                                <th class="text-center">
                                    Email
                                </th>

                                <th class="text-center">
                                    Phone
                                </th>

                                <th class="text-center">
                                    Role
                                </th>

                                <th class="text-center">
                                    Status
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($users as $index => $user)

                                <tr>

                                    {{-- Number --}}
                                    <td class="text-center text-muted  align-middle">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- Image --}}
                                    <td class="text-center text-muted  align-middle">

                                        <div class="">

                                            @if ($user->avatar)

                                                <img src="{{ asset('/storage/img/' . $user->avatar) }}" width="45" height="45"
                                                    class="rounded-circle object-fit-cover border" alt="{{ $user->name }}">

                                            @else

                                                <div class="bg-primary text-white rounded-circle
                                                                           d-flex align-items-center justify-content-center
                                                                           fw-bold" style="width:45px;height:45px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>

                                            @endif
                                        </div>

                                    </td>
                                    <td class="text-center text-muted  align-middle">

                                        <div class="text-center text-muted  align-middle">

                                            <div class="ms-3">

                                                <div class="fw-semibold">
                                                    {{ $user->name }}
                                                </div>



                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td class="text-center text-muted  align-middle">

                                        <span class="text-muted">
                                            <i class="far fa-envelope me-1"></i>
                                            {{ $user->email }}
                                        </span>

                                    </td>


                                    {{-- Phone --}}
                                    <td class="text-center text-muted  align-middle">

                                        @if ($user->phone)

                                            <span>
                                                <i class="fas fa-phone-alt text-muted me-1"></i>
                                                {{ $user->phone }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Role --}}
                                    <td class="text-center text-muted  align-middle">

                                        @if ($user->role === 'admin')

                                            <span class="badge bg-danger rounded-pill">
                                                <i class="fas fa-shield-alt me-1"></i>
                                                Admin
                                            </span>

                                        @elseif ($user->role === 'staff')

                                            <span class="badge bg-info rounded-pill">
                                                <i class="fas fa-user-tie me-1"></i>
                                                Staff
                                            </span>

                                        @else

                                            <span class="badge bg-secondary rounded-pill">
                                                {{ ucfirst($user->role) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="text-center text-muted  align-middle">

                                        @if ($user->disable)

                                            <span class="badge bg-danger rounded-pill">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Disabled
                                            </span>

                                        @else

                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Active
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-center  align-middle">

                                        <a href="{{ route('user.edit', $user->user_id) }}"
                                            class="btn btn-outline-warning btn-sm" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fas fa-users-slash fa-3x mb-3"></i>

                                            <h6 class="fw-bold">
                                                No Users Found
                                            </h6>

                                            <small>
                                                There are currently no users in the system.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                    {{-- {{ $users->links('pagination::bootstrap-5') }} --}}

                </div>

            </div>


            {{-- Footer --}}
            <div class="card-footer bg-white">

                <small class="text-muted">
                    Showing {{ $users->count() }} users
                </small>

            </div>

        </div>

    </div>

    {{-- Search --}}

    <script>

        document.getElementById('userSearch').addEventListener('keyup', function () {

            const search = this.value.toLowerCase();

            document.querySelectorAll('#usersTable tbody tr').forEach(row => {

                row.style.display =
                    row.innerText.toLowerCase().includes(search)
                        ? ''
                        : 'none';

            });

        });

    </script>

@endsection
