@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('Update Admin Role') }}</h3></div>
                <div class="col-md-10 m-auto">
                    <div class="card p-4 mt-4">
                        @if(session('status'))
                            <p class="alert alert-success">{{ session('status') }}</p>
                        @endif

                        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name"
                                    class="form-control"
                                    value="{{ old('name', $admin->name) }}"
                                    id="name" placeholder="Enter name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                    class="form-control"
                                    value="{{ old('email', $admin->email) }}"
                                    id="email" placeholder="Enter email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password (optional)</label>
                                <input type="password" name="password"
                                    class="form-control" id="password"
                                    placeholder="Leave blank to keep unchanged">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="role_name">Select Roles</label>
                                <select name="role_name[]" id="role_name" class="form-control select2" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Admin Role</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('javacontent')
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endsection
