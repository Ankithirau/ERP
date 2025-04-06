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

        .total-field {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .mark-input {
            width: 70px;
        }

        .section-header {
            font-size: 16px;
            font-weight: bold;
            background-color: #e3f2fd;
            padding: 10px;
            border-left: 5px solid #2196f3;
            margin-bottom: 15px;
            border-radius: 4px;
            color: #0d47a1;
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

                    <form action="{{ route('update-marks', $student->student_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Student Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $student->name }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Roll No </label>
                                <input type="text" name="rollno" class="form-control" value="{{ $marks->rollno }}" readonly>
                            </div>
                            <input type="hidden" name="className" value="{{$marks->class}}" id="className">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Academic Year</label>
                                <select name="academic_year" class="form-select" required>
                                    <option value="">Select Academic Year</option>
                                    @foreach ($academicYears as $year)
                                        <option value="{{ $year }}" {{ $marks->academic_year == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                {{-- <input type="text" name="academic_year" class="form-control" value="{{ $marks->academic_year }}" readonly> --}}
                            </div>
                        </div>

                        @foreach ($terms as $termKey => $termLabel)
                            <h5 class="mb-3 section-header">{{ $termLabel }} Marks</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="table-dark-blue">
                                        <tr>
                                            <th>Subject</th>
                                            @foreach (['ct1', 'ct2', 'periodic_test', 'pt_calc', 'subject_enrichment', 'multiple_assessment', 'portfolio', 'exam', 'total'] as $type)
                                                <th>{{ ucfirst(str_replace('_', ' ', $type)) }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody id="marks-table">
                                        @foreach ($subjectMappings as $subject => $key)
                                        @php
                                            $types = ['ct', 'ct2', 'periodic_test', 'pt_calc', 'subject_enrichment', 'multiple_assessment', 'portfolio', 'exam'];

                                            $total = 0;
                                            foreach ($types as $type) {
                                                $total += intval(old("marks.$termKey.$key.$type", $marks[$termKey . '_subject_' . $key . ($type === 'exam' ? '' : '_' . $type)] ?? 0));
                                            }
                                        @endphp
                                            <tr>
                                                <td>{{ $subject }}</td>
                                                @foreach ($types as $type)
                                                    @php
                                                        if ($type === 'ct') {
                                                            $inputClass = 'ct1-input';
                                                        } elseif ($type === 'ct2') {
                                                            $inputClass = 'ct2-input';
                                                        } elseif ($type === 'pt_calc') {
                                                            $inputClass = 'ptcalc-input';
                                                        } elseif ($type === 'periodic_test') {
                                                            $inputClass = 'periodic-test-input';
                                                        } else {
                                                            $inputClass = 'marks-input';
                                                        }
                                                    @endphp
                                                    <td>
                                                        <input type="number"
                                                               name="marks[{{ $termKey }}][{{ $key }}][{{ $type }}]"
                                                               class="form-control {{ $inputClass }}"
                                                               value="{{ intval(old("marks.$termKey.$key.$type", $marks[$termKey . '_subject_' . $key . ($type === 'exam' ? '' : '_' . $type)] ?? '')) }}"
                                                               min="0" max="100" data-sum="{{ $termKey . '_subject_' . $key . ($type === 'exam' ? '' : '_' . $type) }}" style="width: 70px">
                                                    </td>
                                                @endforeach
                                                <td>
                                                    {{-- <input type="text" class="form-control total-field" readonly value="{{ intval($total) }}" style="width: 70px" id="overall-total"> --}}
                                                    <input type="text" class="form-control total-field" readonly value="{{ intval(old("marks.$termKey.$key.total", $marks[$termKey . '_subject_' . $key . '_total'] ?? $total)) }}" style="width: 70px" id="overall-total">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary mt-3">Update Marks</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        document.addEventListener("input", function (event) {
            if (
                event.target.classList.contains("ct1-input") ||
                event.target.classList.contains("ct2-input") ||
                event.target.classList.contains("ptcalc-input") ||
                event.target.classList.contains("periodic-test-input") ||
                event.target.classList.contains("marks-input")
            ) {
                const row = event.target.closest("tr");
                let rowTotal = 0;

                row.querySelectorAll(".ct1-input, .ct2-input, .ptcalc-input, .periodic-test-input, .marks-input").forEach(input => {
                    rowTotal += parseFloat(input.value) || 0;
                });

                const totalField = row.querySelector(".total-field");

                if (rowTotal > 100) {
                    alert("Total marks cannot exceed 100.");
                    totalField.value = rowTotal.toFixed(2);
                    totalField.style.color = "red";
                } else {
                    totalField.value = rowTotal.toFixed(2);
                    totalField.style.color = "black"; // Reset color when within range
                }
                updateGrandTotal();
            }
        });

        function updateGrandTotal() {
            let grandTotal = 0;

            document.querySelectorAll(".total-field").forEach(totalField => {
                grandTotal += parseFloat(totalField.value) || 0;
            });

            document.getElementById("overall-total").value = grandTotal.toFixed(2);
        }

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
                    if (classNumber === 3) {
                        let ptcalValue = (maxCTMarks + (periodicTestValue * factor));

                    } else {
                        let ptcalValue = ((maxCTMarks + periodicTestValue) * factor);

                    }
                    // let periodicTestValue = Math.round(maxCTMarks + (ptcalValue * factor));
                    ptcalInput.val(ptcalValue);
                    console.log("Calculated Periodic Test:", ptcalValue);
                } else {
                    periodicTestInput.val(factor === 0 ? 'No calculation' : '');
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
        document.addEventListener("DOMContentLoaded", function() {
            attachListeners();
        });

    </script>


@endpush
