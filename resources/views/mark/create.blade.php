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
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('student') }}" class="text-decoration-none text-secondary">Marks</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page" class="text-decoration-none">Add</li>
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
                                <div class="col-md-6 mb-3">
                                    <label for="student_id" class="form-label fw-bold">Select Student</label>
                                    <select class="form-select" id="student_id" name="student_id" required>
                                        <option value="" selected disabled>-- Select Student --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="academic_year" class="form-label fw-bold">Academic Year</label>
                                    <input type="text" name="academic_year" id="academic_year" class="form-control"
                                        placeholder="2024-2025" required>
                                </div>
                            </div>

                            <!-- Roll No & Class -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="rollno" class="form-label fw-bold">Roll No</label>
                                    <input type="number" name="rollno" id="rollno" class="form-control"
                                        placeholder="Enter Roll Number" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="class" class="form-label fw-bold">Class</label>
                                    <input type="text" name="class" id="class" class="form-control"
                                        placeholder="Enter Class" required>
                                </div>
                            </div>

                            <!-- Term Selection -->
                            <div class="mb-4">
                                <label for="term" class="form-label fw-bold">Select Term</label>
                                <select name="term" id="term" class="form-select" required onchange="updateTable()">
                                    <option value="" selected disabled>Select Term</option>
                                    <option value="Term1">Term 1</option>
                                    <option value="Term2">Term 2</option>
                                </select>
                            </div>

                            <!-- Marks Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark-blue text-dark">
                                        <tr id="table-header">
                                            <th>Subject</th>
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
                                        @foreach(['English', 'Hindi', 'Marathi/Sanskrit', 'Mathematics', 'Computers'] as $subject)
                                            <tr>
                                                <td class="fw-bold">{{ $subject }}</td>
                                                @foreach(['exam', 'ct', 'pt_calc', 'periodic_test', 'subject_enrichment', 'multiple_assessment', 'portfolio'] as $category)
                                                    <td>
                                                        <input type="number"
                                                            name="marks[{{ strtolower(str_replace(' ', '_', $subject)) }}][{{ $category }}_term1]"
                                                            class="form-control text-center marks-input" required>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
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

    <!-- JavaScript for Term Selection -->
    <script>
        function updateTable() {
            let selectedTerm = document.getElementById("term").value;
            let tableHeader = document.getElementById("table-header");
            let marksTable = document.getElementById("marks-table");
            let categories = ['exam', 'ct', 'pt_calc', 'periodic_test', 'subject_enrichment', 'multiple_assessment', 'portfolio'];

            // Update Table Header
            let newHeaderHTML = `<th>Subject</th>`;
            categories.forEach(category => {
                newHeaderHTML += `<th>${capitalizeWords(category.replace('_', ' '))} (${selectedTerm})</th>`;
            });
            tableHeader.innerHTML = newHeaderHTML;

            // Update Table Inputs
            document.querySelectorAll(".marks-input").forEach((input, index) => {
                let subjectIndex = Math.floor(index / categories.length);
                let categoryIndex = index % categories.length;
                let subject = ['english', 'hindi', 'marathi_sanskrit', 'mathematics', 'computers'][subjectIndex];

                input.name = `marks[${subject}][${categories[categoryIndex]}_${selectedTerm.toLowerCase()}]`;
            });
        }

        function capitalizeWords(str) {
            return str.replace(/\b\w/g, char => char.toUpperCase());
        }
    </script>
@endsection