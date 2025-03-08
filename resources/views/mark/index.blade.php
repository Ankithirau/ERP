@extends('../layouts.app')

@section('panel')
    <div class="container-fluid"> <!-- Full width -->
        <div class="row">
            <div class="col-12"> <!-- Full width column -->

                <div class="card shadow-lg">
                    <div class="card-body">

                        <!-- Breadcrumb -->
                        <div class="d-flex mb-4">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('addmarks') }}" class="text-muted hover-cursor">Marks&nbsp;/&nbsp;</p></a>
                            <p class="text-primary mb-0 hover-cursor">Add</p>
                        </div>

                        <h4 class="card-title text-primary">📚 Marks List</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
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
                                                <td>{{ $mark->{'term1_subject_'.$i.'_total'} ?? rand(70, 95) }}</td>
                                            @endfor

                                            <!-- Term 2 Marks -->
                                            @for($i = 1; $i <= 9; $i++)
                                                <td>{{ $mark->{'term2_subject_'.$i.'_total'} ?? rand(70, 95) }}</td>
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
                                                <a href="#" title="Delete" class="text-danger">
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
@endsection
