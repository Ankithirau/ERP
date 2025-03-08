@extends('../layouts.app')

@push('style')
<style>
    .card-custom {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }
</style>
@endpush

@section('panel')
    <div class="container-fluid"> <!-- Full width -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Centered column -->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">
                                &nbsp;/&nbsp;<a href="{{ route('index') }}" class="text-muted hover-cursor">Users&nbsp;/&nbsp;</a>
                            </p>
                            <p class="text-primary mb-0 hover-cursor">list</p>
                        </div>

                        <h4 class="card-title text-center">Edit User</h4>

                        <form action="{{ route('update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">-- Select --</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                    <option value="peon" {{ $user->role == 'peon' ? 'selected' : '' }}>Peon</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Update User</button>
                            <a href="{{ route('index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
