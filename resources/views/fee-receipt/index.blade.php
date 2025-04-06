@extends('../layouts.app')

@push('style')
    <style>
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
    </style>
@endpush

@section('panel')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('student') }}" class="text-decoration-none text-secondary">Receipt</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Generate</li>
                                </ol>
                            </nav>
                            <a href="{{ route('fees-receipt.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus"></i> Add Receipt
                            </a>
                        </div>

                        <h4 class="card-title mb-3">Receipts</h4>

                        <!-- ✅ Filters Section -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="GET" action="{{ route('receipts.index') }}">
                                    <div class="row g-2 align-items-end">
                                        <!-- Search Field -->
                                        <div class="col-md-4">
                                            <label for="search" class="form-label">Search</label>
                                            <input type="text" name="search" id="search" class="form-control pb-3" placeholder="Search by Receipt ID or Student Name" value="{{ request('search') }}">
                                        </div>

                                        <!-- Payment Date Filter -->
                                        <div class="col-md-3">
                                            <label for="payment_date" class="form-label">Payment Date</label>
                                            <input type="date" name="payment_date" id="payment_date" class="form-control pb-3" value="{{ request('payment_date') }}">
                                        </div>

                                        <!-- Payment Mode Filter -->
                                        <div class="col-md-3">
                                            <label for="payment_mode" class="form-label">Payment Mode</label>
                                            <select name="payment_mode" id="payment_mode" class="form-select">
                                                <option value="">All Modes</option>
                                                <option value="Cash" {{ request('payment_mode') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="Card" {{ request('payment_mode') == 'Card' ? 'selected' : '' }}>Card</option>
                                                <option value="UPI" {{ request('payment_mode') == 'UPI' ? 'selected' : '' }}>UPI</option>
                                                <option value="Bank Transfer" {{ request('payment_mode') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            </select>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="col-md-2 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary w-100">Search</button>
                                            <a href="{{ route('receipts.index') }}" class="btn btn-secondary w-100">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- ✅ Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-dark-blue">
                                    <tr>
                                        <th>#</th>
                                        <th>Receipt ID</th>
                                        <th>Student Name</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Date</th>
                                        <th>Payment Mode</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $s_no = 1; @endphp
                                    @foreach($receipts as $receipt)
                                        <tr>
                                            <td>{{ $s_no++ }}</td>
                                            <td>{{ $receipt->receipt_no }}</td>
                                            <td>{{ $receipt->student_name }}</td>
                                            <td>₹{{ number_format($receipt->amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($receipt->payment_date)->format('d M, Y') }}</td>
                                            <td>{{ $receipt->payment_mode }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('receipts.edit', ['id' => $receipt->id]) }}" class="text-success me-2 text-decoration-none"><i class="mdi mdi-pencil fs-5"></i></a>
                                                <a href="{{ route('download-receipt', $receipt->id) }}" class="text-primary me-2 text-decoration-none"><i class="mdi mdi-printer fs-5"></i></a>
                                                <a href="javascript:void(0);" onclick="confirmDelete('{{ route('delete-receipt', $receipt->id) }}')" class="text-danger text-decoration-none"><i class="mdi mdi-trash-can fs-5"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ✅ Pagination -->
                        <div class="d-flex justify-content-left mt-3">
                            {{ $receipts->links('pagination::bootstrap-4') }}
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
        if (confirm("Are you sure you want to delete this receipt? This action cannot be undone!")) {
            window.location.href = deleteUrl;
        }
    }
</script>
@endpush
