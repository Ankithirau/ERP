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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-header">
                        <div class="breadcrumb-container">
                            <i class="mdi mdi-home"></i>
                            <p><a href="{{ route('student') }}">Student</a> / </p>
                            <p class="text-dark">Edit</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-container">
                            <h4 class="text-center mb-4">Edit Student</h4>
                            <form action="{{ route('update-student', $student->student_id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="admission_no" class="form-label">Admission No.</label>
                                        <input type="text" class="form-control" name="admission_no" 
                                               value="{{ $student->Admission_no }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" name="name" 
                                               value="{{ $student->name }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="mother_name" class="form-label">Mother's Name</label>
                                        <input type="text" class="form-control" name="mother_name" 
                                               value="{{ $student->mother_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="dob" 
                                               value="{{ $student->dob }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="section" class="form-label">Section</label>
                                        <input type="text" class="form-control" name="section" 
                                               value="{{ $student->section }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class" class="form-label">Class</label>
                                        <select class="form-control fw-bold" name="class" required>
                                            <option value="">Select Class</option>
                                            <option value="6" {{ $student->class == '6' ? 'selected' : '' }}>Class 6</option>
                                            <option value="7" {{ $student->class == '7' ? 'selected' : '' }}>Class 7</option>
                                            <option value="8" {{ $student->class == '8' ? 'selected' : '' }}>Class 8</option>
                                            <option value="9" {{ $student->class == '9' ? 'selected' : '' }}>Class 9</option>
                                            <option value="10" {{ $student->class == '10' ? 'selected' : '' }}>Class 10</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="admission_year" class="form-label">Admission Year</label>
                                        <input type="text" class="form-control" name="admission_year" 
                                               value="{{ $student->admission_year }}" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                    <a href="{{ route('student') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div> 
            </div>
        </div>
    </div>
@endsection
