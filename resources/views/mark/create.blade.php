@extends('../layouts.app')

@push('style')
    <style>
        :root {
            --bs-primary: #1a82eb !important;
        }

        .text-primary {
            color: #1a82eb !important;
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

        .table-dark-blue tbody tr:nth-child(even) {
            background-color: #002b5c;
        }

        .table-dark-blue tbody tr:hover {
            background-color: #003366;
        }

        .form-label {
            font-weight: 600;
        }

        .form-select, .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .table th, .table td {
            vertical-align: middle !important;
        }

        .card-header {
            background-color: #f1f2f3;
            color: #151515;
            padding: 15px;
            font-size: 18px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #151616;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb a:hover {
            color: #007bff;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }
    </style>
@endpush

@section('panel')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body">

                        <!-- Alert Messages -->
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

                        <!-- Page Title -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('mark') }}">Marks</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Add</li>
                                </ol>
                            </nav>
                            <a href="{{ route('mark') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-arrow-left"></i> Back to Marks List
                            </a>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('store-marks') }}" method="POST">
                            @csrf

                            <!-- Student Selection -->
                            <div class="row">
                                <!-- <div class="col-md-6 mb-3">
                                    <label for="student_id" class="form-label">Select Student</label>
                                    <select class="form-select" id="student_id" name="student_id" required>
                                        <option value="" selected disabled>-- Select Student --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <div class="col-md-6">
                                    <label for="className" class="form-label fw-bold">Class Name</label>
                                    <select class="form-control fw-bold" id="className" name="class" required>
                                        <option value="">Select Class</option>
                                        <option value="6">Class 6</option>
                                        <option value="7">Class 7</option>
                                        <option value="8">Class 8</option>
                                        <option value="9">Class 9</option>
                                        <option value="10">Class 10</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="sectionName" class="form-label fw-bold">Section</label>
                                    <select class="form-control fw-bold" id="sectionName" name="section" required>
                                        <option value="">Select Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>

                                <!-- <div class="col-md-6 mb-3">
                                    <label for="academic_year" class="form-label">Academic Year</label>
                                    <input type="text" name="academic_year" id="academic_year" class="form-control"
                                        placeholder="2024-2025" required>
                                </div> -->
                            </div>

                            <!-- Roll No & Class -->
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                    <label for="academic_year" class="form-label fw-bold">Academic Year</label>
                                    <input type="text" name="academic_year" id="academic_year" class="form-control"
                                        placeholder="2024-2025" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rollno" class="form-label">Roll No</label>
                                    <input type="number" name="rollno" id="rollno" class="form-control"
                                        placeholder="Enter Roll Number" required>
                                </div>
                            </div>

                            <!-- Term & Subject Selection -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="term" class="form-label">Select Term</label>
                                    <select name="term" id="term" class="form-select" required onchange="updateTable()">
                                        <option value="" selected disabled>Select Term</option>
                                        <option value="Term1">Term 1</option>
                                        <option value="Term2">Term 2</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="student" class="form-label fw-bold">Select Student</label>
                                    <select class="form-control" id="studentold" name="student" >
                                        <option value="">Select Student</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="subject" class="form-label">Select Subject</label>
                                    <select name="subject" id="subject" class="form-select" required>
                                        <option value="" selected disabled>-- Select Subject --</option>
                                        @foreach(['English', 'Hindi', 'Marathi/Sanskrit', 'Mathematics', 'Computers'] as $subject)
                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Marks Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark-blue text-dark">
                                        <tr id="table-header">
                                            <th>Student Name</th>
                                            <th>Exam Marks (Term 1)</th>
                                            <th>CT Marks (Term 1)</th>
                                            <th>PT Calc (Term 1)</th>
                                            <th>Periodic Test (Term 1)</th>
                                            <th>Subject Enrichment (Term 1)</th>
                                            <th>Multiple Assessment (Term 1)</th>
                                            <th>Portfolio (Term 1)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marks-table">
                                            <tr>
                                                <td class="fw-bold" id="student"></td>
                                                       <td> <input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>
                                                       <td><input type="number" name="subject1_term1]" class="form-control text-center marks-input" required></td>

                                            </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="mdi mdi-check-circle"></i> Submit Marks
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#academic_year').blur(function () {
            let academicYear = $(this).val();
            let className = $('#className').val().trim();
            let section = $('#sectionName').val().trim();

            if (academicYear.trim() !== '') {
                $.ajax({
                    url: "{{ route('student-ajax') }}", // Change to your Laravel route
                    type: "POST",
                    data: {
                        academic_year: academicYear,
                        className:className,
                        section:section,
                        _token: "{{ csrf_token() }}" // CSRF protection
                    },
                    success: function (response) {
                        if (response) {
                            console.log(response);
                            let marksTable = $("#marks-table");
                            marksTable.empty(); // Clear existing rows
                            $.each(response, function (index, student) {
                                let row = `<tr><td class="fw-bold">${student.name}</td>`;
                                // Adding input fields for each category dynamically
                                let categories = ['exam', 'ct', 'pt_calc', 'periodic_test', 'subject_enrichment', 'multiple_assessment', 'portfolio'];
                                categories.forEach(category => {
                                    row += `<td>
                                                <input type="number" name="marks[${student.student_id}][${category}_term1]" class="form-control text-center marks-input" required>
                                            </td>`;
                                });
                                row += `</tr>`;
                                marksTable.append(row); // Append row to table
                            });
                } else {
                    alert("Student Not Found! Please Check Input.");
                }
                    },
                    error: function () {
                        alert("Something went wrong.");
                    }
                });
            }
        });
    });
</script>
@endsection
