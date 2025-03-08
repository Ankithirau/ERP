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
            max-width: 700px;
            margin: 0 auto;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
            background-color: #e9ecef;
        }
    </style>
@endpush

@section('panel')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="breadcrumb-container">
                        <i class="mdi mdi-home"></i>
                        <p><a href="{{ route('result') }}">Results</a> / </p>
                        <p class="text-dark">View</p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-container">
                        <h4 class="text-center mb-4">📊 Student Result Details</h4>
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
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Student Name</label>
                                <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Academic Year</label>
                                <input type="text" class="form-control" value="{{ $result->academic_year }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Term 1 Total Marks</label>
                                <input type="text" class="form-control" value="{{ $result->term1_total_marks }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Term 1 Percentage</label>
                                <input type="text" class="form-control" value="{{ $result->term1_percentage }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Term 1 Grade</label>
                                <input type="text" class="form-control" value="{{ $result->term1_grade }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Term 2 Total Marks</label>
                                <input type="text" class="form-control" value="{{ $result->term2_total_marks }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Term 2 Percentage</label>
                                <input type="text" class="form-control" value="{{ $result->term2_percentage }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Term 2 Grade</label>
                                <input type="text" class="form-control" value="{{ $result->term2_grade }}" readonly>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('result') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
