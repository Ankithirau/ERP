@extends('../layouts.app')

@push('style')
<style>
    /* Card Header Styling */
    .card-header {
        background-color: #f1f2f3;
        color: #0f0f0f;
        padding: 15px;
        font-size: 18px;
    }

    /* Breadcrumb Styling */
    .breadcrumb-container {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
    }

    .breadcrumb-container i {
        font-size: 18px;
        color: #0f0f0f;
    }

    .breadcrumb-container p {
        margin: 0;
        font-size: 14px;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #151616;
        transition: color 0.3s ease-in-out;
    }

    .breadcrumb-container a:hover {
        color: #007bff;
    }

    /* Centering Form */
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Form Styling */
    .form-label {
        font-weight: 600;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    /* Button Styling */
    .btn {
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>
@endpush

@section('panel')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- ✅ Card Header with Breadcrumb -->
                <div class="card-header">
                    <div class="breadcrumb-container">
                        <i class="mdi mdi-home"></i>
                        <p><a href="{{ route('index') }}">Users</a> / </p>
                        <p class="text-dark">View</p>
                    </div>
                </div>

                <!-- ✅ Centered Form -->
                <div class="card-body">
                    <div class="form-container">
                        <h4 class="text-center mb-4">User Details</h4>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" readonly />
                                </div>
                            </div>

                            <!-- ✅ Cancel Button -->
                            <div class="text-center">
                                <a href="{{ route('index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div> <!-- End of Form Container -->
                </div> <!-- End of Card Body -->
            </div> <!-- End of Card -->
        </div>
    </div>
</div>
@endsection
