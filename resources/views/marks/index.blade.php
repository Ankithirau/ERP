@extends('../layouts.app')

@push('style')
    <style>
        .table-responsive {
            max-width: 100%;
            overflow-x: auto;
            white-space: nowrap;
            border: 1px solid #0D47A1;
            /* Dark Blue Border */
            border-radius: 5px;
        }

        /* Scrollbar Styling */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #1a82eb;
            /* Dark Blue Scrollbar */
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #1a82eb;
        }
    </style>
@endpush
@section('panel')
    <div class="container-fluid"> <!-- Full width -->
        <div class="row">
            <div class="col-12"> <!-- Full width column -->
                <div class="card shadow-lg">
                    <div class="card-body">

                        <!-- Breadcrumb & Add Marks Button -->
                        {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="mdi mdi-home text-muted"></i>
                                <a href="{{ route('dashboard') }}" class="text-muted mx-1">Home</a> /
                                <a href="{{ route('addmarks') }}" class="text-muted mx-1">Marks</a> /
                                <p class="text-primary mb-0 d-inline">List</p>
                            </div>
                            <a href="{{ route('addmarks') }}" class="btn btn-success btn-sm">
                                <i class="mdi mdi-plus"></i> Add Marks
                            </a>
                        </div> --}}

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <a href="{{ route('dashboard') }}"
                                            class="text-decoration-none text-secondary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('student') }}"
                                            class="text-decoration-none text-secondary">Marks</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page"
                                        class="text-decoration-none">Add</li>
                                </ol>
                            </nav>
                            <a href="{{ route('mark') }}" class="btn btn-primary btn-sm d-none">
                                <i class="mdi mdi-arrow-left"></i> Back to Marks List
                            </a>
                        </div>
                        <div class="mb-4">
                            <a href="{{ route('addmarks') }}" class="btn btn-primary btn-sm shadow-sm">
                                <i class="mdi mdi-plus"></i> Add Marks
                            </a>
                        </div>

                        {{-- Minimalist Filter --}}
                        <form method="GET" action="{{ route('mark') }}" class="mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-2">
                                    <label for="class" class="form-label mb-1 small">Class</label>
                                    <select name="class" id="class" class="form-select form-select-sm">
                                        <option value="">All</option>
                                        @foreach($classes as $value => $label)
                                            <option value="{{ $value }}" {{ request('class') == $label ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div class="col-md-2">
                                    <label for="student_name" class="form-label mb-1 small">Student</label>
                                    <select name="student_name" id="student_name" class="form-select form-select-sm">
                                        <option value="">All</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->name }}" {{ request('student_name') == $student->name ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div class="col-md-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                                    <a href="{{ route('mark') }}" class="btn btn-secondary btn-sm w-100">Reset</a>
                                </div>
                            </div>
                        </form>

                        {{-- <h4 class="card-title text-primary">📚 Marks List</h4> --}}
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-primary text-dark">
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Actions</th>
                                        <th rowspan="2">Student Name</th>
                                        <th rowspan="2">Academic Year</th>
                                        <th rowspan="2">Roll No</th>
                                        <th rowspan="2">Class</th>
                                        <th colspan="9" class="bg-primary text-white">Term 1 Results</th>
                                        <th colspan="9" class="bg-success text-white">Term 2 Results</th>
                                        <th rowspan="2">Term 1 Total</th>
                                        <th rowspan="2">Term 2 Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['English', 'Hindi', 'Marathi', 'Mathematics', 'Science', 'Social', 'Computer', 'EVS', 'GK'] as $subject)
                                            <th>{{ $subject }}</th>
                                        @endforeach
                                        @foreach(['English', 'Hindi', 'Marathi', 'Mathematics', 'Science', 'Social', 'Computer', 'EVS', 'GK'] as $subject)
                                            <th>{{ $subject }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($marks as $mark)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('edit-marks',$mark->student_id) }}" class="text-primary me-2 text-decoration-none">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-success me-2 text-decoration-none d-none">
                                                    <i class="mdi mdi-eye fs-5"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick="confirmDelete('{{ route('delete-marks', $mark->mark_id) }}')"
                                                    title="Delete" class="text-danger text-decoration-none">
                                                    <i class="mdi mdi-trash-can fs-5"></i>
                                                </a>
                                            </td>
                                            <td>{{ $mark->student_name }}</td>
                                            <td>{{ $mark->academic_year }}</td>
                                            <td>{{ $mark->rollno }}</td>
                                            <td>{{ $mark->class }}</td>
                                            @for($i = 1; $i <= 9; $i++)
                                                <td>{{ $mark->{'term1_subject_' . $i . '_total'} ?? rand(70, 95) }}</td>
                                            @endfor
                                            @for($i = 1; $i <= 9; $i++)
                                                <td>{{ $mark->{'term2_subject_' . $i . '_total'} ?? rand(70, 95) }}</td>
                                            @endfor
                                            <td><strong>{{ $mark->term1_total ?? rand(650, 700) }}</strong></td>
                                            <td><strong>{{ $mark->term2_total ?? rand(650, 700) }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-left mt-3">
                            {{ $marks->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Script -->
    <script>
        function confirmDelete(deleteUrl) {
            if (confirm("Are you sure you want to delete this record? This action cannot be undone!")) {
                window.location.href = deleteUrl;
            }
        }
    </script>
@endsection