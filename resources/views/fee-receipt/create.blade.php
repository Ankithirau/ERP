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

        .form-control,
        select,
        textarea {
            border-radius: 8px;
            padding: 10px;
            border: 2px solid blue;
            /* सभी इनपुट बॉर्डर को ब्लू किया */
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
                                        <input type="text" class="form-control" id="student_id" name="student_id" readonly
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="classSelect" class="form-label">Class</label>
                                        <select class="form-control fw-bold pb-3" id="classSelect" name="class" required>
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="section" class="form-label">Section</label>
                                        <select class="form-control fw-bold pb-3" id="section" name="section" required>
                                            <option value="">Select Class</option>
                                            @foreach ($sections as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
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
                                            <input type="number" class="form-control fee-input" name="fees[{{ $index }}][amount]"
                                                placeholder="Amount (₹)" required>
                                            <input type="hidden" name="fees[{{ $index }}][name]" value="{{ $fee }}">
                                        </div>
                                    </div>
                                @endforeach

                                <div class="fee-summary mb-4" style="display: flex; gap: 30px; align-items: center;">
                                    <div class="fee-summary-item" style="display: flex; align-items: center; gap: 5px;">
                                        <strong>Total</strong>
                                        <input type="text" id="totalFees" class="form-control" style="width: 100px; text-align: right;" readonly>
                                    </div>
                                
                                    <div class="fee-summary-item ml-3" style="display: flex; align-items: center; gap: 5px;">
                                        <strong>Paid</strong>
                                        <input type="text" id="paidFees" class="form-control" style="width: 100px; text-align: right;" value="0" readonly>
                                    </div>
                                
                                    <div class="fee-summary-item ml-3" style="display: flex; align-items: center; gap: 5px;">
                                        <strong>Remaining</strong>
                                        <input type="text" id="remainingFees" class="form-control" style="width: 100px; text-align: right;" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="payment_date" class="form-label">Payment Date</label>
                                        <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="payment_mode" class="form-label">Payment Mode</label>
                                        <select class="form-control pb-3" id="payment_mode" name="payment_mode" required>
                                            <option value="">Select Payment Mode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3" id="payment_info_container" style="display: none;">
                                    <div class="col-md-6">
                                        <label id="payment_info_label" class="form-label"></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="payment_info" name="payment_info" placeholder="" required>
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
        // document.addEventListener("DOMContentLoaded", function () {
        //     const classSelect = document.getElementById("classSelect");
        //     const totalFeesInput = document.getElementById("totalFees");
        //     const paidFeesInput = document.getElementById("paidFees");
        //     const remainingFeesInput = document.getElementById("remainingFees");
        //     const feeInputs = document.querySelectorAll(".fee-input");

        //     const feesStructure = {
        //         1: 29000, 2: 29000, 3: 29000, 4: 29000,
        //         5: 31500, 6: 31500, 7: 31500,
        //         8: 34550, 9: 34550, 10: 34550
        //     };

        //     classSelect.addEventListener("change", function () {
        //         let selectedClass = this.value;
        //         let totalFees = feesStructure[selectedClass] || 0;

        //         totalFeesInput.value = totalFees;
        //         paidFeesInput.value = 0; 
        //         remainingFeesInput.value = totalFees; 
        //     });

        //     feeInputs.forEach(input => {
        //         input.addEventListener("input", calculateRemainingFees);
        //     });

        //     function calculateRemainingFees() {
        //         let totalFees = parseInt(totalFeesInput.value) || 0;
        //         let paidAmount = 0;

        //         feeInputs.forEach(input => {
        //             paidAmount += parseInt(input.value) || 0;
        //         });

        //         if (paidAmount > totalFees) {
        //             alert("Paid amount cannot exceed total fees!");
        //             paidAmount = totalFees;
        //             this.value = totalFees - (paidAmount - parseInt(this.value || 0));
        //         }

        //         paidFeesInput.value = paidAmount;
        //         remainingFeesInput.value = totalFees - paidAmount;
        //     }
        // });

        document.addEventListener("DOMContentLoaded", function () {
    const classSelect = document.getElementById("classSelect");
    const studentSelect = document.getElementById("student_name");
    const totalFeesInput = document.getElementById("totalFees");
    const paidFeesInput = document.getElementById("paidFees");
    const remainingFeesInput = document.getElementById("remainingFees");
    const feeInputs = document.querySelectorAll(".fee-input");

    const feesStructure = {
        1: 29000, 2: 29000, 3: 29000, 4: 29000,
        5: 31500, 6: 31500, 7: 31500,
        8: 34550, 9: 34550, 10: 34550
    };

    let previousRemainingFees = 0;

    classSelect.addEventListener("change", function () {
        let selectedClass = this.value;
        let totalFees = feesStructure[selectedClass] || 0;

        totalFeesInput.value = totalFees - previousRemainingFees;
        paidFeesInput.value = 0;
        remainingFeesInput.value = totalFees - previousRemainingFees;
    });

    studentSelect.addEventListener("change", function () {
        let studentId = this.options[this.selectedIndex].getAttribute("data-id");

        if (!studentId) {
            previousRemainingFees = 0;
            totalFeesInput.value = "";
            remainingFeesInput.value = "";
            resetPaidFees();
            return;
        }

        fetch(`{{ route('student.fees', '') }}/${studentId}`)
            .then(response => response.json())
            .then(data => {
                previousRemainingFees = data.remaining_fees || 0;
                let selectedClass = classSelect.value;
                let totalFees = feesStructure[selectedClass] || 0;

                totalFeesInput.value = Math.abs(totalFees - previousRemainingFees);
                remainingFeesInput.value =  Math.abs(totalFees - previousRemainingFees);
            })
            .catch(error => console.error("Error fetching student fees:", error));
    });

    feeInputs.forEach(input => {
        input.addEventListener("input", function () {
            calculateRemainingFees();
        });
    });

    

    function calculateRemainingFees() {
        let totalFees = parseInt(totalFeesInput.value) || 0;
        let paidAmount = 0;

        feeInputs.forEach(input => {
            paidAmount += parseInt(input.value) || 0;
        });

        if (paidAmount > totalFees) {
            alert("Paid amount cannot exceed total fees!");
            return;
        }

        paidFeesInput.value = paidAmount;
        remainingFeesInput.value = totalFees - paidAmount;
    }
});

        document.getElementById('student_name').addEventListener('change', function () {
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

