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
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('store-marks') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="academicYear" class="form-label">Academic Year</label>
                                    <input type="text" id="academicYear" name="academic_year" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="className" class="form-label">Class</label>
                                    <select id="className" name="class" class="form-control pb-3" required>
                                        <option value="">Select Class</option>
                                        <option value="6">Class 6</option>
                                        <option value="7">Class 7</option>
                                        <option value="8">Class 8</option>
                                        <option value="9">Class 9</option>
                                        <option value="10">Class 10</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="sectionName" class="form-label">Section</label>
                                    <select id="sectionName" name="section" class="form-control pb-3" required>
                                        <option value="">Select Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="term" class="form-label">Term</label>
                                    <select id="term" name="term" class="form-control pb-3" required>
                                        <option value="">Select Term</option>
                                        <option value="term1">Term 1</option>
                                        <option value="term2">Term 2</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select id="subject" name="subject" class="form-control pb-3" required>
                                        <option value="">Select Subject</option>
                                        <option value="English">English</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Marathi/Sanskrit">Marathi/Sanskrit</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="Computers">Computers</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-dark-blue text-dark">
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Roll No.</th>
                                            <th>Exam Marks (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>CT Marks (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>PT Calc (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Periodic Test (<span id="term-display">Term 1</span>)</th>
                                            <th>Subject Enrichment (<span id="term-display">Term 1</span>)</th>
                                            <th>Multiple Assessment (<span id="term-display">Term 1</span>)</th>
                                            <th>Portfolio (<span id="term-display">Term 1</span>)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marks-table">
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">Select details to load students</td>
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
            function updateTermLabels() {
                let selectedTerm = $('#term').val();
                if (selectedTerm) {
                    $('.term-label').text(`${selectedTerm}`);
                } else {
                    $('.term-label').text('Term 1');
                }
            }

            // Call function when term dropdown changes
            $('#term').on('change', function () {
                updateTermLabels();
            });

            // Initial call in case term is pre-selected
            updateTermLabels();

            function fetchStudents() {
                let academicYear = $('#academicYear').val().trim();
                let className = $('#className').val().trim();
                let section = $('#sectionName').val().trim();
                let term = $('#term').val().trim();
                let subject = $('#subject').val().trim();

                if (!academicYear || !className || !section || !term || !subject) {
                    console.warn("Missing required fields: Academic Year, Class, Section, Term, or Subject.");
                    return;
                }

                $.ajax({
                    url: "{{ route('student-ajax') }}", // Laravel route
                    type: "POST",
                    data: {
                        academic_year: academicYear,
                        class: className,
                        section: section,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function () {
                        $("#marks-table").html('<tr><td colspan="9" class="text-center">Loading students...</td></tr>');
                    },
                    success: function (response) {
                        let marksTable = $("#marks-table");
                        marksTable.empty(); // Clear previous content

                        if (!response || response.length === 0) {
                            marksTable.html('<tr><td colspan="9" class="text-center text-danger">No students found!</td></tr>');
                            return;
                        }

                        let subjectMappings = {
                            'English': 'subject_1',
                            'Hindi': 'subject_2',
                            'Marathi/Sanskrit': 'subject_3',
                            'Mathematics': 'subject_4',
                            'Computers': 'subject_5'
                        };

                        if (!subjectMappings[subject]) {
                            alert("Invalid subject selected.");
                            return;
                        }

                        let subjectColumn = `${term}_${subjectMappings[subject]}`;

                        // let fields = {
                        //     'exam': `${subjectColumn}`,
                        //     'ct': `${subjectColumn}_ct`,
                        //     'pt_calc': `${subjectColumn}_pt_calc`,
                        //     'periodic_test': `${subjectColumn}_periodic_test`,
                        //     'subject_enrichment': `${subjectColumn}_subject_enrichment`,
                        //     'multiple_assessment': `${subjectColumn}_multiple_assessment`,
                        //     'portfolio': `${subjectColumn}_portfolio`
                        // };

                        // Define the fields based on term selection
                        let fields = {
                            'exam': `${term}_${subject}`,
                            'ct': `${term}_${subject}_ct`,
                            'pt_calc': `${term}_${subject}_pt_calc`,
                            'periodic_test': `${term}_${subject}_periodic_test`,
                            'subject_enrichment': `${term}_${subject}_subject_enrichment`,
                            'multiple_assessment': `${term}_${subject}_multiple_assessment`,
                            'portfolio': `${term}_${subject}_portfolio`
                        };

                        // Loop through students and populate table
                        $.each(response, function (index, student) {
                            let row = `<tr>
                                        <td class="fw-bold">${student.name}</td>
                                        <td><input type="text" name="marks[${student.student_id}][rollno]" class="form-control text-center" value="${student.rollno || ''}" required></td>`;

                            // Adding dynamic fields
                            Object.keys(fields).forEach(key => {
                                row += `<td>
                                            <input type="number" name="marks[${student.student_id}][${fields[key]}]" class="form-control text-center marks-input" required>
                                        </td>`;
                            });

                            row += `</tr>`;
                            marksTable.append(row);
                        });

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $("#marks-table").html('<tr><td colspan="9" class="text-center text-danger">Something went wrong. Please try again!</td></tr>');
                    }
                });
            }

            // Trigger AJAX when any of these fields change
            $('#subject').on('change', fetchStudents);
        });
    </script>
@endpush
