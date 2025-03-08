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
    <div class="container-fluid"> <!-- Make it full width -->
        <div class="row">
            <div class="col-12"> <!-- Full width column -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Student&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">List</p>
                        </div>
                        <h4 class="card-title">Students</h4>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-dark-blue sticky-top">
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
                                            <td class="text-center" style="white-space: nowrap;">
                                                <a href="edit-url" title="Edit" class="text-primary me-3">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="view-url" title="View" class="text-success me-3">
                                                    <i class="mdi mdi-eye fs-5"></i>
                                                </a>
                                                <a href="delete-url" title="Delete" class="text-danger">
                                                    <i class="mdi mdi-trash-can fs-5"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-left mt-3">
                            {{ $student->links('pagination::bootstrap-4') }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection