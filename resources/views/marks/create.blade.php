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
                                            <th>CT 1 Marks (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>CT 2 Marks (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Periodic Test (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>PT Calc (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Subject Enrichment (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Multiple Assessment (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Portfolio (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Exam Marks (<span id="term-display" class="term-label">Term 1</span>)</th>
                                            <th>Total Marks</th> <!-- New column for total -->
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
            function calculateTotalMarks(row) {
                let total = 0;
                row.find('.marks-input,.ct1-input, .ct2-input, .ptcalc-input, .periodic-test-input').each(function () {
                    let value = parseFloat($(this).val()) || 0;
                    total += value;
                });

                if (total > 100) {
                    alert("Total marks cannot exceed 100.");
                    row.find('.total-marks').text(total).css("color", "red");
                } else {
                    row.find('.total-marks').text(total).css("color", "black");
                }
                row.find(".total-marks-input").val(total);
            }

            $(document).on('input', '.marks-input,.ct1-input, .ct2-input, .ptcalc-input, .periodic-test-input', function () {
                let row = $(this).closest('tr');
                calculateTotalMarks(row);
            });

            function updateTermLabels() {
                let selectedTerm = $('#term').val().toUpperCase();
                if (selectedTerm) {
                    let formattedTerm = selectedTerm.replace(/term(\d+)/i, (_, num) => `Term ${num}`);
                    $('.term-label').text(formattedTerm.charAt(0).toUpperCase() + formattedTerm.slice(1));
                } else {
                    $('.term-label').text('Term 1');
                }
            }

            $('#term').on('change', function () {
                updateTermLabels();
            });

            updateTermLabels();

            function calculatePeriodicTest(ct1Input, ct2Input, ptcalInput, periodicTestInput) {
                let ct1Value = parseFloat(ct1Input.val()) || 0;
                let ct2Value = parseFloat(ct2Input.val()) || 0;
                let periodicTestValue = parseFloat(periodicTestInput.val()) || 0;
                // let ptcalValue = parseFloat(ptcalInput.val()) || 0;
                let classValue = $('#className').val();
                let factor = 0;
                let classNumber = parseInt(classValue.replace('Class ', '').trim()) || 0;

                if (classNumber === 1 || classNumber === 2) {
                    factor = 0;
                } else if (classNumber === 3 || classNumber === 4) {
                    factor = 0.2; 
                } else if (classNumber >= 5 && classNumber <= 10) {
                    factor = 0.125;
                }

                console.log("CT1:", ct1Value, "CT2:", ct2Value, "periodicTest:", periodicTestValue, "Factor:", factor);

                if (factor > 0) {
                    let maxCTMarks = Math.max(ct1Value, ct2Value); 
                    let ptcalValue = Math.round((maxCTMarks + periodicTestValue) * factor);
                    // let periodicTestValue = Math.round(maxCTMarks + (ptcalValue * factor));
                    ptcalInput.val(ptcalValue);
                    console.log("Calculated ptcal Test:", ptcalInput);
                } else {
                    ptcalInput.val(factor === 0 ? 'No calculation' : '');
                }
            }

            function attachListeners() {
                $('#marks-table').on('input', '.ct1-input, .ct2-input, .periodic-test-input', function () {
                    let row = $(this).closest('tr');
                    let ct1Input = row.find('.ct1-input');
                    let ct2Input = row.find('.ct2-input');
                    let ptcalInput = row.find('.ptcalc-input');
                    let periodicTestInput = row.find('.periodic-test-input');

                    calculatePeriodicTest(ct1Input, ct2Input, ptcalInput, periodicTestInput);
                });
            }

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
                    url: "{{ route('student-ajax') }}",
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

                        let fields = {
                            'ct': `${term}_${subject}_ct`,
                            'ct_2': `${term}_${subject}_ct_2`,
                            'periodic_test': `${term}_${subject}_periodic_test`,
                            'pt_calc': `${term}_${subject}_pt_calc`,
                            'subject_enrichment': `${term}_${subject}_subject_enrichment`,
                            'multiple_assessment': `${term}_${subject}_multiple_assessment`,
                            'portfolio': `${term}_${subject}_portfolio`,
                            'exam': `${term}_${subject}`,
                        };

                        $.each(response, function (index, student) {
                            let row = `<tr>
                                        <td class="fw-bold">${student.name}</td>
                                        <td><input type="text" name="marks[${student.student_id}][rollno]" class="form-control text-center" value="${student.rollno || ''}" required></td>`;

                            Object.keys(fields).forEach(key => {
                                let inputClass = '';

                                // let inputClass = key === 'pt_calc' ? 'ptcalc-input' : (key === 'periodic_test' ? 'periodic-test-input' : 'marks-input');
                                if (key === 'ct') {
                                    inputClass = 'ct1-input';
                                    maxLength = 10;
                                } else if (key === 'ct_2') {
                                    inputClass = 'ct2-input';
                                    maxLength = 10;
                                } else if (key === 'pt_calc') {
                                    inputClass = 'ptcalc-input';
                                    maxLength = 100;
                                } else if (key === 'periodic_test') {
                                    inputClass = 'periodic-test-input';
                                    maxLength = 100;
                                }else{
                                    inputClass = 'marks-input';
                                    maxLength = 100;
                                }
                                row += `<td>
                                    <input type="number" name="marks[${student.student_id}][${fields[key]}]" class="form-control text-center ${inputClass}" max="${maxLength}" min="0" required>
                                </td>`;
                            });

                            row += `<td class="fw-bold"><span class="total-marks">0</span> <input type="hidden" name="marks[${student.student_id}][${term}_${subject}_total]" class="total-marks-input" value="0"></td>`;
                            row += `</tr>`;
                            marksTable.append(row);
                            attachListeners();

                        });

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $("#marks-table").html('<tr><td colspan="9" class="text-center text-danger">Something went wrong. Please try again!</td></tr>');
                    }
                });
            }

            $('#subject').on('change', fetchStudents);
        });
    </script>
@endpush
