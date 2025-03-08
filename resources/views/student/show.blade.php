@extends('../layouts.app')

@push('style')
    <style>
            /* Card Header Styling */
            .card-header {
            background-color: #f1f2f3; /* Dark Blue */
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
            /* font-weight: bold; */
        }

        /* Breadcrumb Styling (Matching List Page) */
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

        /* Centering Form */
        .form-container {
            max-width: 600px; /* Form width */
            margin: 0 auto; /* Centering */
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

                    <!-- ✅ Card Header with List Page Style Breadcrumbs -->
                    <div class="card-header">
                        <div class="breadcrumb-container">
                            <i class="mdi mdi-home"></i>
                            <p><a href="{{ route('student') }}">Student</a> / </p>
                            <p class="text-dark">View</p>
                        </div>
                    </div>

                    <!-- ✅ Centered View Form -->
                    <div class="card-body">
                        <div class="form-container">
                            <h4 class="text-center mb-4">Student Details</h4>
                            <form>
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="student_id" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" name="student_id" value="{{ $student->student_id }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="admission_no" class="form-label">Admission No.</label>
                                        <input type="text" class="form-control" name="admission_no" value="{{ $student->Admission_no }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $student->name }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mother_name" class="form-label">Mother's Name</label>
                                        <input type="text" class="form-control" name="mother_name" value="{{ $student->mother_name }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="section" class="form-label">Section</label>
                                        <input type="text" class="form-control" name="section" value="{{ $student->section }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="admission_year" class="form-label">Admission Year</label>
                                        <input type="number" class="form-control" name="admission_year" value="{{ $student->admission_year }}" readonly>
                                    </div>
                                </div>

                                <!-- ✅ Back Button -->
                                <div class="text-center">
                                    <a href="{{ route('student') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div> <!-- End of Form Container -->
                    </div> <!-- End of Card Body -->
                </div> <!-- End of Card -->
            </div>
        </div>
    </div>
@endsection
