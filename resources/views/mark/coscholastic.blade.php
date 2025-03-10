@extends('../layouts.app')

@push('style')
    <style>
        .table-dark-blue {
            background-color: #1a82eb;
            /* Dark Blue */
            color: white;
        }

        .table-dark-blue thead {
            background-color: #1a82eb;
            /* Darker Blue for Header */
        }

        .table-dark-blue tbody tr:nth-child(even) {
            background-color: #1a82eb;
            /* Slightly Lighter Blue */
        }

        .table-dark-blue tbody tr:hover {
            background-color: #1a82eb;
            /* Hover Effect */
        }
    </style>
@endpush


@section('panel')
    <div class="container-fluid"> <!-- Make it full width -->
        <div class="row">
            <div class="col-12"> <!-- Full width column -->
                <div class="card">
                    <div class="card-body">
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
                                            class="text-decoration-none text-secondary">Co-Scholastic</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page"
                                        class="text-decoration-none">List</li>
                                </ol>
                            </nav>
                            <a href="{{ route('mark') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-arrow-left"></i> Back to Marks List
                            </a>
                        </div>
                        <h4 class="card-title">Co-Scholastic</h4>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-dark-blue sticky-top">
                                    <tr>
                                        <th>Id</th>
                                        <th>Student</th>
                                        <th>Admission Year</th>
                                        <th>Class</th>
                                        <th>Term1 Work Education</th>
                                        <th>Term1 Art Eductaion</th>
                                        <th>Term1 Physical Education</th>
                                        <th>Term1 Discipline</th>
                                        <th>Term2 Work Education</th>
                                        <th>Term2 Art Eductaion</th>
                                        <th>Term2 Physical Education</th>
                                        <th>Term2 Discipline</th>
                                        <th>Created</th>
                                        <th>Modified</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-left mt-3">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection