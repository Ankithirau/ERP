@extends('../layouts.app')

@push('style')
    <style>
        .card-header {
            background-color: #f1f2f3;
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
        }

        .readonly-select {
            pointer-events: none; /* User select नहीं कर सकता */
            background-color: #e9ecef; /* Disabled जैसा दिखे */
            cursor: not-allowed;
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
            border: 2px solid blue;
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
                        <div class="d-flex justify-content-between align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}"
                                            class="text-decoration-none text-secondary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('student') }}"
                                            class="text-decoration-none text-secondary">Receipt</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page"
                                        class="text-decoration-none">Generate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="form-container">
                            <h4 class="text-center mb-5">Edit Fee Receipt</h4>
                            <form action="{{ route('receipts.update', $receipt->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="student_name" class="form-label">Student Name</label>
                                        <select class="form-control pb-3 readonly-select" id="student_name" name="student_name" required>
                                            <option value="">Select Student</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->name }}" data-id="{{ $student->student_id }}"
                                                    {{ $receipt->student_name == $student->name ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="student_id" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $receipt->student_id }}" readonly required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class" class="form-label">Class</label>
                                        <select class="form-control fw-bold pb-3" id="class" name="class" required>
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $key => $value)
                                                <option value="{{ $key }}" {{ $receipt->class == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="section" class="form-label">Section</label>
                                        <select class="form-control fw-bold pb-3" id="section" name="section" required>
                                            <option value="">Select Class</option>
                                            @foreach ($sections as $key => $value)
                                                <option value="{{ $key }}" {{ $receipt->section == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <h5 class="mt-4">Fees Breakdown</h5>

                                @foreach($receipt->fees_details as $index => $fee)
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ $fee['name'] }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="fees[{{ $index }}][amount]" value="{{ $fee['amount'] }}" required>
                                            <input type="hidden" name="fees[{{ $index }}][name]" value="{{ $fee['name'] }}">
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="payment_date" class="form-label">Payment Date</label>
                                        <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $receipt->payment_date }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="payment_mode" class="form-label">Payment Mode</label>
                                        <select class="form-control pb-3" id="payment_mode" name="payment_mode" required>
                                            <option value="Cash" {{ $receipt->payment_mode == 'Cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="Card" {{ $receipt->payment_mode == 'Card' ? 'selected' : '' }}>Card</option>
                                            <option value="UPI" {{ $receipt->payment_mode == 'UPI' ? 'selected' : '' }}>UPI</option>
                                            <option value="Bank Transfer" {{ $receipt->payment_mode == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" id="payment_info_container" style="display: none;">
                                    <div class="col-md-6">
                                        <label id="payment_info_label" class="form-label"></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="payment_info" name="payment_info" value="{{ $receipt->payment_info ?? '' }}" placeholder="Enter Payment Details">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update Receipt</button>
                                    <a href="{{ route('receipts.index') }}" class="btn btn-secondary">Cancel</a>
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
    document.getElementById('payment_mode').addEventListener('change', function () {
        var selectedMode = this.value;
        var infoContainer = document.getElementById('payment_info_container');
        var infoInput = document.getElementById('payment_info');
        var infoLabel = document.getElementById('payment_info_label');

        if (selectedMode === "") {
            infoContainer.style.display = "none";
            infoInput.removeAttribute('required');
            infoInput.value = ""; 
        } else {
            infoContainer.style.display = "flex";
            infoInput.setAttribute('required', 'required');
            
            if (selectedMode === "Cash") {
                infoLabel.innerText = "Enter Receipt Number";
                infoInput.placeholder = "e.g., RCPT123456";
            } else if (selectedMode === "Card") {
                infoLabel.innerText = "Enter Last 4 Digits of Card";
                infoInput.placeholder = "e.g., 1234";
            } else if (selectedMode === "UPI") {
                infoLabel.innerText = "Enter UPI ID";
                infoInput.placeholder = "e.g., abc@upi";
            } else if (selectedMode === "Bank Transfer") {
                infoLabel.innerText = "Enter Transaction ID";
                infoInput.placeholder = "e.g., TXN12345678";
            }
        }
    });

</script>
@endpush
