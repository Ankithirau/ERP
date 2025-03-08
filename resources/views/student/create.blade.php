@extends('../layouts.app')

@push('style')
<style>
    .card-header {
        background-color: #1a82eb; /* Dark Blue */
        color: white;
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
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                    <div class="card-header">
                    <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('student') }}" class="text-muted hover-cursor">Student&nbsp;/&nbsp;</p></a>
                            <p class="text-primary mb-0 hover-cursor">List</p>
                        </div>
                        <h4 class="mb-0">Add Student</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store-student') }}" method="POST">
                            @csrf
                            <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="student_id" name="student_id" required>
                                </div> -->
                                <div class="col-md-6">
                                    <label for="admission_no" class="form-label">Admission No.</label>
                                    <input type="text" class="form-control" id="admission_no" name="admission_no" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="mother_name" class="form-label">Mother's Name</label>
                                    <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="section" class="form-label">Section</label>
                                    <input type="text" class="form-control" id="section" name="section" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="admission_year" class="form-label">Admission Year</label>
                                    <input type="text" class="form-control" id="admission_year" name="admission_year" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('student') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
