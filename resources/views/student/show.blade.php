@extends('../layouts.app')

@section('panel')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Student</div>

                <div class="card-body">
                <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('student') }}" class="text-muted hover-cursor">Student&nbsp;/&nbsp;</p></a>
                            <p class="text-primary mb-0 hover-cursor">List</p>
                        </div>
                    <form action="#" method="">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" name="student_id" value="{{ $student->student_id }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="admission_no" class="form-label">Admission No.</label>
                            <input type="text" class="form-control" name="admission_no" value="{{ $student->Admission_no }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $student->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control" name="mother_name" value="{{ $student->mother_name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" class="form-control" name="section" value="{{ $student->section }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="admission_year" class="form-label">Admission Year</label>
                            <input type="number" class="form-control" name="admission_year" value="{{ $student->admission_year }}" readonly>
                        </div>


                        <a href="{{ route('student') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
