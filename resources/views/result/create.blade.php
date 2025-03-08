@extends('../layouts.app')

@push('style')
<style>
    .card-custom {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table-dark-blue {
        background-color: #1a82eb;
        color: white;
    }
    .table-dark-blue thead {
        background-color: #004080;
    }
</style>
@endpush

@section('panel')

<div class="container-fluid"> <!-- Full-width layout -->
    <div class="row">
        <div class="col-12"> <!-- Full-width column -->
            <div class="card shadow-lg card-custom">
                <div class="card-body">
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
                    <!-- Breadcrumb -->
                    <div class="d-flex mb-4">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;
                            <a href="{{ route('result') }}" class="text-muted hover-cursor">Results&nbsp;/&nbsp;</a>
                        </p>
                        <p class="text-primary mb-0 hover-cursor">Add</p>
                    </div>

                    <h4 class="card-title text-primary text-center">📊 Add Student Result</h4>

                    <!-- Form -->
                    <form action="{{ route('store-result') }}" method="POST">
                        @csrf

                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student Name</label>
                            <select class="form-control" id="student_id" name="student_id" required>
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->student_id  }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <div class="col-md-6 mb-3">
                                <label for="academic_year" class="form-label">Academic Year</label>
                                <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term1_total_marks" class="form-label">Term 1 Total Marks</label>
                                <input type="number" class="form-control" id="term1_total_marks" name="term1_total_marks" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term1_percentage" class="form-label">Term 1 Percentage</label>
                                <input type="text" class="form-control" id="term1_percentage" name="term1_percentage" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term1_grade" class="form-label">Term 1 Grade</label>
                                <input type="text" class="form-control" id="term1_grade" name="term1_grade" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term2_total_marks" class="form-label">Term 2 Total Marks</label>
                                <input type="number" class="form-control" id="term2_total_marks" name="term2_total_marks" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term2_percentage" class="form-label">Term 2 Percentage</label>
                                <input type="text" class="form-control" id="term2_percentage" name="term2_percentage" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="term2_grade" class="form-label">Term 2 Grade</label>
                                <input type="text" class="form-control" id="term2_grade" name="term2_grade" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-50">Submit Result</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
