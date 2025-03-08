@extends('../layouts.app')

@push('style')
    <style>
        /* Card Header Styling */
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

        /* Form Styling */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

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
            padding: 10px 20px;
        }
    </style>
@endpush

@section('panel')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- ✅ Success & Error Messages -->
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

                <!-- ✅ Card Header with Breadcrumb -->
                <div class="card-header">
                    <div class="breadcrumb-container">
                        <i class="mdi mdi-home"></i>
                        <p><a href="{{ route('result') }}">Results</a> / </p>
                        <p class="text-dark">Add</p>
                    </div>
                </div>

                <!-- ✅ Centered Form -->
                <div class="card-body">
                    <div class="form-container">
                        <h4 class="text-center mb-4">📊 Add Student Result</h4>
                        <form action="{{ route('store-result') }}" method="POST">
                            @csrf
                            
                            <!-- Student Selection -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="student_id" class="form-label">Student Name</label>
                                    <select class="form-select" id="student_id" name="student_id" required>
                                        <option value="">-- Select Student --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Academic Year -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="academic_year" class="form-label">Academic Year</label>
                                    <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                                </div>
                            </div>

                            <!-- Term 1 & Term 2 Details (2-Column Layout) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="term1_total_marks" class="form-label">Term 1 Total Marks</label>
                                    <input type="number" class="form-control" id="term1_total_marks" name="term1_total_marks" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="term1_percentage" class="form-label">Term 1 Percentage</label>
                                    <input type="text" class="form-control" id="term1_percentage" name="term1_percentage" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="term1_grade" class="form-label">Term 1 Grade</label>
                                    <input type="text" class="form-control" id="term1_grade" name="term1_grade" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="term2_total_marks" class="form-label">Term 2 Total Marks</label>
                                    <input type="number" class="form-control" id="term2_total_marks" name="term2_total_marks" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="term2_percentage" class="form-label">Term 2 Percentage</label>
                                    <input type="text" class="form-control" id="term2_percentage" name="term2_percentage" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="term2_grade" class="form-label">Term 2 Grade</label>
                                    <input type="text" class="form-control" id="term2_grade" name="term2_grade" required>
                                </div>
                            </div>

                            <!-- ✅ Submit & Cancel Buttons -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('result') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div> <!-- End of Form Container -->
                </div> <!-- End of Card Body -->
            </div> <!-- End of Card -->
        </div>
    </div>
</div>

@endsection
