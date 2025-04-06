@extends('../layouts.app')
@push('style')

@endpush
@section('panel')
<div class="container-fluid">
    <div class="row">
        <div class="col-12"> 
            <div class="container py-3" id="reportCardContainer">
                <!-- Header -->
                <div class="text-center mb-2">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="School Logo" style="height: 70px;">
                    <h4 class="fw-bold text-primary mt-2 mb-1">Sunny's Spring Dale School</h4>
                    <p class="mb-0 text-muted fw-semibold small">CBSE Affiliation No: <strong>1130268</strong></p>
                    <p class="text-muted small mb-1">Annual Student Report Card – Academic Session {{ $request->year }}</p>
                    <hr class="w-25 mx-auto border-primary opacity-75">
                </div>

                <!-- Student Info -->
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-body bg-white rounded-3">
                        <div class="row g-2 align-items-center">
                            {{-- <div class="col-2 text-center"> --}}
                                {{-- <img src="{{ asset('images/faces/face'.rand(1,30).'.jpg') }}" class="img-fluid rounded border" alt="Student Photo"> --}}
                            {{-- </div> --}}
                            <div class="col-12">
                                <div class="row g-1 small">
                                    <div class="col-4"><strong>Name:</strong> {{ $student->name }}</div>
                                    <div class="col-4"><strong>Roll No:</strong> {{ $marks->rollno }}</div>
                                    <div class="col-4"><strong>Admission No:</strong> {{ $student->Admission_no }}</div>
                                    <div class="col-4"><strong>DOB:</strong> {{ date('d-M-Y', strtotime($student->dob)) }}</div>
                                    <div class="col-4"><strong>Class / Sec:</strong> {{ $student->class }} - {{ $student->section }}</div>
                                    <div class="col-4"><strong>Mother's Name:</strong> {{ $student->mother_name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scholastic -->
                @foreach ($termData as $term)
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-header bg-primary text-white fw-semibold small border-0 py-1">
                        {{ $term['name'] }} Scholastic Performance
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm text-center mb-0 align-middle small">
                            <thead class="table-light">
                                <tr>
                                    <th>Subject</th>
                                    <th>Periodic Test</th>
                                    <th>Subject Enrichment</th>
                                    <th>Multiple Assessment</th>
                                    <th>{{ $term['class'] <= 5 ? 'CT Marks' : 'Portfolio' }}</th>
                                    <th>Mid Term</th>
                                    <th>Total</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($term['subjects'] as $subject)
                                <tr>
                                    <td>{{ $subject['name'] }}</td>
                                    <td>{{ $subject['pt'] }}</td>
                                    <td>{{ $subject['enrich'] }}</td>
                                    <td>{{ $subject['assess'] }}</td>
                                    <td>
                                    @if($term['class'] <= 5)
                                        {{ $subject['ct'] ?? '' }} 
                                    @else
                                        {{ $subject['portfolio'] ?? '' }}
                                    @endif
                                </td>
                                    <td>{{ $subject['mid'] }}</td>
                                    <td>{{ $subject['total'] }}</td>
                                    <td>{{ $subject['grade'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row px-3 py-1 bg-primary small text-white border-top">
                            <div class="col-md-4"><strong>Percentage:</strong> {{ $term['percentage'] }}%</div>
                            <div class="col-md-4"><strong>Total Marks:</strong> {{ $term['total'] }}</div>
                            <div class="col-md-4"><strong>Grade:</strong> {{ $term['grade'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Co-Scholastic -->
                @if(count($coScholastic) > 0)
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-header bg-primary text-white fw-semibold small border-0 py-1">
                        Co-Scholastic Areas
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm text-center m-0 align-middle small">
                            <thead class="table-light">
                                <tr>
                                    <th>Activity</th>
                                    <th>Term I</th>
                                    <th>Term II</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coScholastic as $activity)
                                <tr>
                                    <td>{{ $activity['activity'] }}</td>
                                    <td>{{ $activity['term1'] ?? '-' }}</td>
                                    <td>{{ $activity['term2'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                <!-- Annual Summary (only shown when viewing both terms) -->
                @if(count($termData) > 1 && isset($termData[0]['percentage']) && isset($termData[1]['percentage']))
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-header bg-primary text-white fw-semibold small border-0 py-1">
                        Annual Summary
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm mb-0 align-middle small">
                            <thead class="table-light">
                                <tr>
                                    <th>Term</th>
                                    <th>Total Marks</th>
                                    <th>Percentage</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($termData as $term)
                                <tr>
                                    <td>{{ $term['name'] }}</td>
                                    <td>{{ $term['total'] }}</td>
                                    <td>{{ $term['percentage'] }}%</td>
                                    <td>{{ $term['grade'] }}</td>
                                </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td>Overall</td>
                                    <td>{{ $termData[0]['total'] + $termData[1]['total'] }}</td>
                                    <td>{{ round(($termData[0]['percentage'] + $termData[1]['percentage']) / 2, 2) }}%</td>
                                    <td>{{ $termData[0]['overall_grade'] ?? '' }}</td>
                                    {{-- <td>{{ $this->calculateOverallGrade(round(($termData[0]['percentage'] + $termData[1]['percentage']) / 2, 2)) }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Remarks -->
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-body bg-primary text-white small py-2">
                        <strong>Teacher's Remarks:</strong>
                        <p class="mb-0">{{ $student->name }} is a sincere and enthusiastic student who performs well in academics and participates actively in school activities.</p>
                    </div>
                </div>

                <!-- Signatures -->
                <div class="row text-center mt-3 mb-2 small">
                    <div class="col-4">
                        <hr class="mb-1"><small class="text-muted">Class Teacher</small>
                    </div>
                    <div class="col-4">
                        <hr class="mb-1"><small class="text-muted">Principal</small>
                    </div>
                    <div class="col-4">
                        <hr class="mb-1"><small class="text-muted">Parent / Guardian</small>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center text-muted small">
                    <hr>
                    <p class="mb-0">© {{ date('Y') }} Sunny's Spring Dale School</p>
                </div>
            </div>

            <!-- Print Button -->
            <div class="text-center my-4">
                <button onclick="printReportCard()" class="btn btn-outline-primary btn-sm px-4">Print Report Card</button>
                <a href="{{ route('view-result') }}" class="btn btn-secondary btn-sm px-4">Back</a>
            </div>
        </div>
    </div>
</div>

<script>
    function printReportCard() {
        var printContent = document.getElementById('reportCardContainer').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
@endsection