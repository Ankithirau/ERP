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
    <div class="container-fluid"> <!-- Make it full width -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Centered column -->
                <div class="card card-custom">
                    <div class="card-body">
                    <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('index') }}" class="text-muted hover-cursor">Users&nbsp;/&nbsp;</p></a>
                            <p class="text-primary mb-0 hover-cursor">List</p>
                        </div>

                        <!-- <h4 class="card-title text-primary">📚 Student List</h4> -->

                        <h4 class="card-title text-center">Create User</h4>
                        <form action="{{ route('store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                <option value="">--select---</option>
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="peon"></option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
