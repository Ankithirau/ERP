@extends('../layouts.app')

@push('style')
<style>
    .card-header {
        background-color: #f1f2f3;
        color: rgb(15, 15, 15);
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
            color: rgb(15, 15, 15);
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

    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

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

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="card-header">
                    <div class="breadcrumb-container">
                        <i class="mdi mdi-home"></i>
                        <p><a href="{{ route('result') }}">Profile</a>  </p>
                        <p class="text-dark"></p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-container">
                    <h4 class="text-center mb-5">Update Profile</h4>
                    <form action="{{ route('profileUpdate', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                    
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                    
                        <div class="row">
                            <!-- New Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password (Optional)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                    
                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    </div> 
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
