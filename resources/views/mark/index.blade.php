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

                        {{-- <h4 class="card-title text-primary">📚 Marks List</h4> --}}

                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-primary text-dark">
                                    <tr>
                                        <th rowspan="2">Mark ID</th>
                                        <th rowspan="2">Student Name</th>
                                        <th rowspan="2">Academic Year</th>
                                        <th rowspan="2">Roll No</th>
                                        <th rowspan="2">Class</th>
                                        <th colspan="9" class="bg-primary text-white">Term 1 Results</th>
                                        <th colspan="9" class="bg-success text-white">Term 2 Results</th>
                                        <th rowspan="2">Term 1 Total</th>
                                        <th rowspan="2">Term 2 Total</th>
                                        <th rowspan="2">Actions</th>
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
                                            <td>{{ $mark->mark_id }}</td>
                                            <td>{{ $mark->student_name }}</td>
                                            <td>{{ $mark->academic_year }}</td>
                                            <td>{{ $mark->rollno }}</td>
                                            <td>{{ $mark->class }}</td>

                                            <!-- Term 1 Marks -->
                                            @for($i = 1; $i <= 9; $i++)
                                                <td>{{ $mark->{'term1_subject_' . $i . '_total'} ?? rand(70, 95) }}</td>
                                            @endfor

                                            <!-- Term 2 Marks -->
                                            @for($i = 1; $i <= 9; $i++)
                                                <td>{{ $mark->{'term2_subject_' . $i . '_total'} ?? rand(70, 95) }}</td>
                                            @endfor

                                            <td><strong>{{ $mark->term1_total ?? rand(650, 700) }}</strong></td>
                                            <td><strong>{{ $mark->term2_total ?? rand(650, 700) }}</strong></td>

                                            <td class="text-nowrap">
                                                <a href="#" title="Edit" class="text-primary me-2">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="#" title="View" class="text-success me-2">
                                                    <i class="mdi mdi-eye fs-5"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick="confirmDelete('{{ route('delete-student', $mark->mark_id) }}')"
                                                    title="Delete" class="text-danger">
                                                    <i class="mdi mdi-trash-can fs-5"></i>
                                                </a>
                                            </td>
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