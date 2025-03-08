@extends('../layouts.app')
@push('style')

<style>
    .table-dark-blue {
        background-color: #1a82eb;
        color: white;
    }
    .table-dark-blue thead {
        background-color: #1a82eb;
    }
    .table-dark-blue tbody tr:nth-child(even) {
        background-color: #1a82eb;
    }
    .table-dark-blue tbody tr:hover {
        background-color: #1a82eb;
        color: white; /* Hover पर सफेद टेक्स्ट */
    }
</style>
@endpush

@section('panel')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-lg">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}"
                                        class="text-decoration-none text-secondary">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('student') }}"
                                        class="text-decoration-none text-secondary">Result</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page"
                                    class="text-decoration-none">List</li>
                            </ol>
                        </nav>
                        <a href="{{ route('create-result') }}" class="btn btn-primary btn-sm ">
                            <i class="mdi mdi-plus"></i> Add Result
                        </a>
                    </div>                    

                    <h4 class="card-title text-primary">📊 Student Results</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark-blue text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Result ID</th>
                                    <th>Student</th>
                                    <th>Academic Year</th>
                                    <th>Term 1 Marks</th>
                                    <th>Term 1 %</th>
                                    <th>Term 1 Grade</th>
                                    <th>Term 2 Marks</th>
                                    <th>Term 2 %</th>
                                    <th>Term 2 Grade</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $s_no = 1; @endphp
                                @foreach($result as $results)
                                <tr>
                                    <td>{{ $s_no++ }}</td>
                                    <td>{{ $results->result_id }}</td>
                                    <td>{{ $results->student_name }}</td>
                                    <td>{{ $results->academic_year }}</td>
                                    <td><strong>{{ $results->term1_total_marks }}</strong></td>
                                    <td class="text-primary"><strong>{{ $results->term1_percentage }}%</strong></td>
                                    <td class="fw-bold">{{ $results->term1_grade }}</td>
                                    <td><strong>{{ $results->term2_total_marks }}</strong></td>
                                    <td class="text-success"><strong>{{ $results->term2_percentage }}%</strong></td>
                                    <td class="fw-bold">{{ $results->term2_grade }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('edit-result', $results->result_id) }}" title="Edit" class="text-primary me-2">
                                            <i class="mdi mdi-pencil fs-6"></i>
                                        </a>
                                        <a href="{{ route('view-result', $results->result_id) }}" title="View" class="text-success me-2">
                                            <i class="mdi mdi-eye fs-6"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="confirmDelete('{{ route('delete-result', $results->result_id) }}')" title="Delete" class="text-danger delete-confirm">
                                            <i class="mdi mdi-trash-can fs-6"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-left mt-3">
                        {{ $result->links('pagination::bootstrap-4') }}
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
            if (confirm("Are you sure you want to delete this record? This action cannot be undone!")) {
                window.location.href = deleteUrl;
            }
        }
</script>
@endpush