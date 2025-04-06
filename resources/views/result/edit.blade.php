@extends('../layouts.app')

@push('style')
    <style>
        /* ==== Card Header Styling ==== */
        .card-header {
            background-color: #f1f2f3;
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        /* ==== Breadcrumb Styling ==== */
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

        /* ==== Form Styling ==== */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
            display: inline-block;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
            font-size: 14px;
            background-color: #fafafa;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }

        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.4);
        }

        /* ==== Section Header Styling ==== */
        .section-header {
            font-size: 16px;
            font-weight: bold;
            background-color: #e3f2fd;
            padding: 10px;
            border-left: 5px solid #2196f3;
            margin-bottom: 15px;
            border-radius: 4px;
            color: #0d47a1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ==== Button Styling ==== */
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            border: none;
        }

        .btn-primary {
            background-color: #4facfe;
            color: #fff;
            box-shadow: 0 4px 10px rgba(79, 172, 254, 0.3);
        }

        .btn-primary:hover {
            background-color: #00f2fe;
            box-shadow: 0 6px 14px rgba(0, 242, 254, 0.4);
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            background-color: #d6d6d6;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
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
                        <p class="text-dark">Edit</p>
                    </div>
                </div>

                <!-- ✅ Form -->
                <div class="card-body">
                    <div class="form-container">
                        <h4 class="text-center mb-4">Edit Student Result</h4>
                        <form action="{{ route('update-result', $result->result_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- <div class="col-md-6 mb-3">
                                <label for="student_id" class="form-label">Student Name</label>
                                <select class="form-control" id="student_id" name="student_id" required>
                                    <option value="">-- Select Student --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->student_id }}"
                                            {{ $student->student_id == $result->student_id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> -->
                            <div class="section-header">Student Information</div>
                            <!-- Student Selection (Read-Only) -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="student_id" class="form-label">Student Name</label>
                                    <input type="text" class="form-control" id="student_id" name="student_name" value="{{ $student->name }}" readonly>
                                    <input type="hidden" name="student_id" value="{{ $student->student_id }}">
                                </div>
                            </div>

                            <!-- Academic Year -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="academic_year" class="form-label">Academic Year</label>
                                    <input type="text" class="form-control" id="academic_year" name="academic_year" value="{{ $result->academic_year }}" required>
                                </div>
                            </div>

                            <!-- ✅ Term 1 Section -->
                            <div class="section-header">Term 1 Details</div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="term1_total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="term1_total_marks" name="term1_total_marks" value="{{ $result->term1_total_marks }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="term1_percentage" class="form-label">Percentage</label>
                                    <input type="text" class="form-control" id="term1_percentage" name="term1_percentage" value="{{ $result->term1_percentage }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="term1_grade" class="form-label">Grade</label>
                                    <input type="text" class="form-control" id="term1_grade" name="term1_grade" value="{{ $result->term1_grade }}" required>
                                </div>
                            </div>

                            <!-- ✅ Term 2 Section -->
                            <div class="section-header">Term 2 Details</div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="term2_total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="term2_total_marks" name="term2_total_marks" value="{{ $result->term2_total_marks }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="term2_percentage" class="form-label">Percentage</label>
                                    <input type="text" class="form-control" id="term2_percentage" name="term2_percentage" value="{{ $result->term2_percentage }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="term2_grade" class="form-label">Grade</label>
                                    <input type="text" class="form-control" id="term2_grade" name="term2_grade" value="{{ $result->term2_grade }}" required>
                                </div>
                            </div>

                            <!-- ✅ Submit & Cancel Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Update Result</button>
                                <a href="{{ route('result') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
