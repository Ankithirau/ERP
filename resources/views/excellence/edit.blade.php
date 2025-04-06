@extends('../layouts.app')

@push('style')
    <style>
        :root {
            --bs-primary: #1a82eb !important;
        }

        .btn-primary {
            background-color: #1a82eb !important;
            border-color: #1a82eb !important;
        }

        .table-dark-blue {
            background-color: #1a82eb;
            color: white;
        }

        .table-dark-blue thead {
            background-color: #004080;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-dark-blue tbody tr:hover {
            background-color: #003366;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }
    </style>
@endpush

@section('panel')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="mb-4">Edit Excellence Marks</h4>

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
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('update.excellence', $excellence->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="academicYear" class="form-label">Academic Year</label>
                                    <select id="academicYear" name="academic_year" class="form-select" required>
                                        <option value="">Select Academic Year</option>
                                        @foreach ($academicYears as $year)
                                            <option value="{{ $year }}" {{ $excellence->academic_year == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    {{-- <input type="text" id="academicYear" name="academic_year" class="form-control" value="{{ $excellence->academic_year }}" required> --}}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="className" class="form-label">Class</label>
                                    <select id="className" name="class" class="form-control pb-3" required>
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $key => $value)
                                            <option value="{{ $key }}" {{ $excellence->class == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="sectionName" class="form-label">Section</label>
                                    <select id="sectionName" name="section" class="form-control pb-3" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section }}" {{ $excellence->section == $section ? 'selected' : '' }}>{{ $section }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark-blue text-dark">
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Roll No.</th>
                                            <th colspan="4">Term 1</th>
                                            <th colspan="4">Term 2</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Work Education</th>
                                            <th>Art Education</th>
                                            <th>Physical Education</th>
                                            <th>Discipline</th>
                                            <th>Work Education</th>
                                            <th>Art Education</th>
                                            <th>Physical Education</th>
                                            <th>Discipline</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">{{ $student->name }}</td>
                                            <td><input type="text" name="rollno" class="form-control text-center" value="{{ $excellence->rollno }}" required></td>
                                            
                                            <td><input type="number" name="term1_work_education" class="form-control text-center" value="{{ $excellence->term1_work_education }}"></td>
                                            <td><input type="number" name="term1_art_education" class="form-control text-center" value="{{ $excellence->term1_art_education }}"></td>
                                            <td><input type="number" name="term1_physical_education" class="form-control text-center" value="{{ $excellence->term1_physical_education }}"></td>
                                            <td><input type="number" name="term1_discipline" class="form-control text-center" value="{{ $excellence->term1_discipline }}"></td>

                                            <td><input type="number" name="term2_work_education" class="form-control text-center" value="{{ $excellence->term2_work_education }}"></td>
                                            <td><input type="number" name="term2_art_education" class="form-control text-center" value="{{ $excellence->term2_art_education }}"></td>
                                            <td><input type="number" name="term2_physical_education" class="form-control text-center" value="{{ $excellence->term2_physical_education }}"></td>
                                            <td><input type="number" name="term2_discipline" class="form-control text-center" value="{{ $excellence->term2_discipline }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Marks</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
