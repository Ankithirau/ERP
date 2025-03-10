@extends('../layouts.app')

@push('style')
    <style>
        .card-header {
            background-color: #f1f2f3;
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
        }

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
            background-color: #f8f9fa;
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
                    <!-- ✅ Breadcrumbs for Navigation -->
                    <div class="card-header">
                        <div class="breadcrumb-container">
                            <i class="mdi mdi-home"></i>
                            <p><a href="{{ route('student') }}">Student</a> / </p>
                            <p class="text-dark">View</p>
                        </div>
                    </div>

                    <!-- ✅ Student Details Form -->
                    <div class="card-body">
                        <div class="form-container">
                            <h4 class="text-center mb-4">Student Details</h4>
                            <form>
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" class="form-control" value="{{ $student->student_id }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Admission No.</label>
                                        <input type="text" class="form-control" value="{{ $student->Admission_no }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Student Name</label>
                                        <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mother's Name</label>
                                        <input type="text" class="form-control" value="{{ $student->mother_name }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" value="{{ $student->dob }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Section</label>
                                        <input type="text" class="form-control" value="{{ $student->section }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Class</label>
                                        <input type="text" class="form-control" value="{{ $student->class }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Admission Year</label>
                                        <input type="text" class="form-control" value="{{ $student->admission_year }}" readonly>
                                    </div>
                                </div>

                                <!-- ✅ Back Button -->
                                <div class="text-center">
                                    <a href="{{ route('student') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div> 
            </div>
        </div>
    </div>
@endsection
