@extends('../layouts.app')
@push('style')

<style>
    .table-dark-blue {
        background-color: #1a82eb; /* Dark Blue */
        color: white;
    }
    .table-dark-blue thead {
        background-color: #004080; /* Darker Blue for Header */
    }
    .table-dark-blue tbody tr:nth-child(even) {
        background-color: #002b5c; /* Slightly Lighter Blue */
    }
    .table-dark-blue tbody tr:hover {
        background-color: #003366; /* Hover Effect */
    }
</style>
@endpush

@section('panel')

<div class="container-fluid"> <!-- Full-width layout -->
    <div class="row">
        <div class="col-12"> <!-- Full-width column -->

            <div class="card shadow-lg">
                <div class="card-body">
                @if(session('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

                    <!-- Breadcrumb -->
                    <div class="d-flex mb-4">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('create-result') }}" class="text-muted hover-cursor">Result&nbsp;/&nbsp;</p></a>
                        <p class="text-primary mb-0 hover-cursor">Add</p>
                    </div>

                    <h4 class="card-title text-primary">📊 Student Results</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark-blue text-white">
                                <tr>
                                    <th>Index</th>
                                    <th>Result ID</th>
                                    <th>Student</th>
                                    <th>Academic Year</th>
                                    <th>Term 1 Total Marks</th>
                                    <th>Term 1 Percentage</th>
                                    <th>Term 1 Grade</th>
                                    <th>Term 2 Total Marks</th>
                                    <th>Term 2 Percentage</th>
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
                                        <a href="{{ route('edit-result',$results->result_id ) }}" title="Edit" class="text-primary me-2 text-decoration-none">
                                            <i class="mdi mdi-pencil fs-5"></i>
                                        </a>
                                        <a href="{{ route('view-result',$results->result_id ) }}" title="View" class="text-success me-2 text-decoration-none">
                                            <i class="mdi mdi-eye fs-5"></i>
                                        </a>
                                        <a href="{{ route('delete-result',$results->result_id) }}" title="Delete" class="text-danger text-decoration-none">
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
                        {{ $result->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
