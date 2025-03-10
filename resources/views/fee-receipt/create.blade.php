@extends('../layouts.app')

@push('style')
    <style>
        .card-header {
            background-color: #f1f2f3;
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control, select, textarea {
            border-radius: 8px;
            padding: 10px;
            border: 2px solid blue; /* सभी इनपुट बॉर्डर को ब्लू किया */
        }

        .btn {
            border-radius: 8px;
            padding: 8px 20px;
        }
    </style>
@endpush

@section('panel')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-header">
                            <h4 class="text-center mb-0">Generate Fee Receipt</h4>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="form-container">
                                <form action="{{ route('receipts.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="student_name" class="form-label">Student Name</label>
                                            <select class="form-control pb-3" id="student_name" name="student_name" required>
                                                <option value="">Select Student</option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->name }}" data-id="{{ $student->student_id }}">
                                                        {{ $student->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Student ID Input (Readonly) -->
                                        <div class="col-md-6">
                                            <label for="student_id" class="form-label">Student ID</label>
                                            <input type="text" class="form-control" id="student_id" name="student_id" readonly required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="class" class="form-label">Class</label>
                                            <select class="form-control fw-bold pb-3" id="class" name="class" required>
                                                <option value="">Select Class</option>
                                                <option value="6">Class 6</option>
                                                <option value="7">Class 7</option>
                                                <option value="8">Class 8</option>
                                                <option value="9">Class 9</option>
                                                <option value="10">Class 10</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="section" class="form-label">Section</label>
                                            <input type="text" class="form-control" id="section" name="section" required>
                                        </div>
                                    </div>

                                    <h5 class="mt-4">Fees Breakdown</h5>

                                    @php
    $feesCategories = [
        'Admission Fees',
        'Co-curricular Activities',
        'Curricular Activities',
        'Exam Fees',
        'Lab Fees',
        'Term Fees',
        'Tuition Fees'
    ];
                                    @endphp

                                    @foreach($feesCategories as $index => $fee)
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">{{ $fee }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="fees[{{ $index }}][amount]" placeholder="Amount (₹)" required>
                                                <input type="hidden" name="fees[{{ $index }}][name]" value="{{ $fee }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="payment_date" class="form-label">Payment Date</label>
                                            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="payment_mode" class="form-label">Payment Mode</label>
                                            <select class="form-control pb-3" id="payment_mode" name="payment_mode" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Card</option>
                                                <option value="UPI">UPI</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Generate Receipt</button>
                                        <a href="#" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
@endsection
@push('script')
<script>
    document.getElementById('student_name').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('student_id').value = selectedOption.getAttribute('data-id') || '';
    });
</script>

@endpush