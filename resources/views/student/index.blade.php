@extends('../layouts.app')

@push('style')
    <style>
        /* Table Styling */
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

        /* Breadcrumbs Styling */
        .breadcrumb-item a {
            text-decoration: none;
            color: #6c757d;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb-item a:hover {
            color: #007bff;
        }

        /* Action Buttons */
        .action-icons a {
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .action-icons a:hover {
            transform: scale(1.2);
        }

    </style>
@endpush

@section('panel')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <!-- ✅ Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- ✅ Breadcrumbs & Add Button -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Breadcrumbs -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('student') }}">Students</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">List</li>
                                </ol>
                            </nav>

                            <!-- Add Student Button -->
                            <a href="{{ route('create-student') }}" class="btn btn-primary d-flex align-items-center btn-sm">
                                <i class="mdi mdi-plus me-1"></i> Add Student
                            </a>
                        </div>

                        <h4 class="card-title mb-3">Students List</h4>

                        <!-- ✅ Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-dark-blue">
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Admission No.</th>
                                        <th>Name</th>
                                        <th>Mother's Name</th>
                                        <th>Date of Birth</th>
                                        <th>Section</th>
                                        <th>Admission Year</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $s_no = 1; @endphp
                                    @foreach($student as $students)
                                        <tr>
                                            <td>{{ $s_no++ }}</td>
                                            <td>{{ $students->student_id }}</td>
                                            <td>{{ $students->Admission_no }}</td>
                                            <td>{{ $students->name }}</td>
                                            <td>{{ $students->mother_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($students->dob)->format('d M, Y') }}</td>
                                            <td>{{ $students->section }}</td>
                                            <td>{{ $students->admission_year }}</td>
                                            <td class="text-center action-icons" style="white-space: nowrap;">
                                                <a href="{{ route('edit-student', $students->student_id) }}" title="Edit" class="text-primary me-2">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="{{ route('view-student', $students->student_id) }}" title="View" class="text-success me-2">
                                                    <i class="mdi mdi-eye fs-5"></i>
                                                </a>
                                                <a href="javascript:void(0);" 
                                                onclick="confirmDelete('{{ route('delete-student', $students->student_id) }}')" 
                                                title="Delete" 
                                                class="text-danger">
                                                 <i class="mdi mdi-trash-can fs-5"></i>
                                             </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ✅ Pagination -->
                        <div class="d-flex justify-content-left mt-3">
                            {{ $student->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    function confirmDelete(deleteUrl) {
        if (confirm("Are you sure you want to delete this student? This action cannot be undone!")) {
            window.location.href = deleteUrl;
        }
    }
</script>
@endpush