@extends('../layouts.app')

@section('panel')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
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
                        <h4 class="card-title text-primary">📚 Add Marks</h4>

                        <form action="{{ route('store-marks') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <select class="form-control" id="student_id" name="student_id" required>
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->student_id  }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="mb-3">
                                <label for="academic_year" class="form-label">Academic Year</label>
                                <input type="text" name="academic_year" id="academic_year" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="rollno" class="form-label">Roll No</label>
                                <input type="number" name="rollno" id="rollno" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="class" class="form-label">Class</label>
                                <input type="text" name="class" id="class" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="term" class="form-label">Term</label>
                                <select name="term" id="term" class="form-control" required onchange="updateTable()">
                                    <option value="" disabled selected>Select Term</option>
                                    <option value="Term1">Term 1</option>
                                    <option value="Term2">Term 2</option>
                                </select>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
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
                                                <td>{{ $subject }}</td>
                                                @foreach(['exam', 'ct', 'pt_calc', 'periodic_test', 'subject_enrichment', 'multiple_assessment', 'portfolio'] as $category)
                                                    <td>
                                                        <input type="number" name="marks[{{ strtolower(str_replace(' ', '_', $subject)) }}][{{ $category }}_term1]" class="form-control marks-input" required>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit Marks</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
