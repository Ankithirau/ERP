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

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('excellence') }}" class="text-decoration-none text-secondary">Co-Scholastic</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Add</li>
                                </ol>
                            </nav>
                            <a href="{{ route('excellence') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-arrow-left"></i> Back to excellence List
                            </a>
                        </div>


                        <form action="{{ route('store.excellence') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="academicYear" class="form-label">Academic Year</label>
                                    <select id="academicYear" name="academic_year" class="form-select" required>
                                        <option value="">Select Academic Year</option>
                                        @foreach ($academicYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    
                                    {{-- <input type="text" id="academicYear" name="academic_year" class="form-control" required> --}}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="className" class="form-label">Class</label>
                                    <select id="className" name="class" class="form-control pb-3" required>
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="sectionName" class="form-label">Section</label>
                                    <select id="sectionName" name="section" class="form-control pb-3" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section }}">{{ $section }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark-blue text-dark">
                                        <tr>
                                            <th rowspan="2">Student Name</th>
                                            <th rowspan="2">Roll No.</th>
                                            <th colspan="4">Term 1</th>
                                            <th colspan="4">Term 2</th>
                                            {{-- <th rowspan="2">Total</th> --}}
                                        </tr>
                                        <tr>
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
                                    <tbody id="marks-table">
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Select details to load students</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit Marks</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function calculateTotalMarks(row) {
                let total = 0;
                row.find('.marks-input').each(function () {
                    let value = parseFloat($(this).val()) || 0;
                    total += value;
                });
                row.find('.total-marks').text(total);
            }

            $(document).on('input', '.marks-input', function () {
                let row = $(this).closest('tr');
                calculateTotalMarks(row);
            });

            function fetchStudents() {
                let academicYear = $('#academicYear').val().trim();
                let className = $('#className').val().trim();
                let section = $('#sectionName').val().trim();

                if (!academicYear || !className || !section) {
                    console.warn("Missing required fields: Academic Year, Class, or Section.");
                    return;
                }

                $.ajax({
                    url: "{{ route('student-ajax') }}",
                    type: "POST",
                    data: {
                        academic_year: academicYear,
                        class: className,
                        section: section,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function () {
                        $("#marks-table").html('<tr><td colspan="10" class="text-center">Loading students...</td></tr>');
                    },
                    success: function (response) {
                        let marksTable = $("#marks-table");
                        marksTable.empty();

                        if (!response || response.length === 0) {
                            marksTable.html('<tr><td colspan="10" class="text-center text-danger">No students found!</td></tr>');
                            return;
                        }

                        $.each(response, function (index, student) {
                            let row = `<tr>
                                        <td class="fw-bold">${student.name}</td>
                                        <td><input type="text" name="marks[${student.student_id}][rollno]" class="form-control text-center" value="${student.rollno || ''}" required></td>
                                        
                                            <td><input type="number" name="marks[${student.student_id}][term1_work_education]" class="form-control text-center marks-input term1" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term1_art_education]" class="form-control text-center marks-input term1" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term1_physical_education]" class="form-control text-center marks-input term1" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term1_discipline]" class="form-control text-center marks-input term1" required></td>

                                            <!-- Term 2 Inputs -->
                                            <td><input type="number" name="marks[${student.student_id}][term2_work_education]" class="form-control text-center marks-input term2" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term2_art_education]" class="form-control text-center marks-input term2" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term2_physical_education]" class="form-control text-center marks-input term2" required></td>
                                            <td><input type="number" name="marks[${student.student_id}][term2_discipline]" class="form-control text-center marks-input term2" required></td>
                                        <!-- <td class="fw-bold total-marks">0</td>-->
                                    </tr>`;
                            marksTable.append(row);
                        });
                    }
                });
            }

            $('#sectionName').on('change', fetchStudents);
        });
    </script>
@endpush
