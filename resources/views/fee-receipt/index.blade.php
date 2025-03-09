@extends('../layouts.app')

@push('style')
    <style>
        /* Table Styling */
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
                        
                        <!-- ✅ Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- ✅ Breadcrumbs -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
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
                            <a href="{{ route('fees-receipt.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus"></i> Add Receipt
                            </a>
                        </div>

                        <h4 class="card-title mb-3">Receipts</h4>

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
                                            <td>₹{{ number_format($receipt->amount_paid, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($receipt->payment_date)->format('d M, Y') }}</td>
                                            <td>{{ $receipt->payment_mode }}</td>
                                            <td class="text-center action-icons">
                                                <a href="{{ route('receipts.edit', ['id' => $receipt->id]) }}" title="Edit" class="text-success me-2">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="{{ route('download-receipt', $receipt->id) }}" title="Download" class="text-primary me-2">
                                                    <i class="mdi mdi-download fs-5"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="confirmDelete('{{ route('delete-receipt', $receipt->id) }}')" title="Delete" class="text-danger">
                                                    <i class="mdi mdi-trash-can fs-5"></i>
                                                </a>
                                                
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
