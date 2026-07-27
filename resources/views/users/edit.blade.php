@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit User</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex w-100 justify-content-between align-content-center ">
                        <div class="form-group mb-3 w-50 ">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group mb-3 w-50 ml-5">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-content-center ">
                        <div class="form-group mb-3 w-50 mr-5">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group mb-3 w-50 ">
                            <label>Gender</label>
                            <select name="gender_id" class="form-control">
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->gender_id }}"
                                        {{ $user->gender_id == $gender->gender_id ? 'selected' : '' }}>
                                        {{ $gender->gender_title_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>
                    <div class="d-flex w-100 justify-content-between align-content-center ">
                        <div class="form-group mb-3 w-50 mr-5">
                            <label>Role</label>

                            <select name="role" class="form-control">

                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="Cashier" {{ $user->role == 'Cashier' ? 'selected' : '' }}>
                                    Cashier
                                </option>

                            </select>
                        </div>
                        <div class="form-group mb-3 w-50">
                            <label>Status</label>
                            <div class="form-check">
                                <input type="hidden" name="disable" value="0">
                                <input type="checkbox" name="disable" value="1" class="form-check-input" id="disable"
                                    {{ $user->disable == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="disable">
                                    Disabled
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 d-flex justify-content-center align-items-center">
                        <div class="form-group mb-3 text-center">
                            <label>Current Avatar</label>
                            <br>
                            <label for="avatar-input" style="cursor:pointer;">
                                <img id="preview-image"
                                    src="{{ $user->avatar ? asset('storage/img/' . $user->avatar) : asset('storage/img/noneuser.png') }}"
                                    width="120" height="120" class=" object-fit-cover">
                            </label>
                            <div class="form-group mb-3">
                                <input type="file" name="avatar" id="avatar-input" hidden
                                    accept="image/png,image/jpg,image/jpeg">
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary ml-3">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('avatar-input')
            .addEventListener('change', function(event) {
                const image = document.getElementById('preview-image');
                const file = event.target.files[0];
                if (file) {
                    image.src = URL.createObjectURL(file);
                }
            });
    </script>
@endsection
