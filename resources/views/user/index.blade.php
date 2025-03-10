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

    /* Breadcrumbs Styling */
    .breadcrumb-item a {
        text-decoration: none;
        color: #6c757d;
        transition: color 0.3s ease-in-out;
    }

    .breadcrumb-item a:hover {
        color: #007bff;
    }

    /* Action Icons */
    .action-icons a {
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .action-icons a:hover {
        transform: scale(1.2);
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

                    <!-- ✅ Breadcrumbs & Add Button -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">List</li>
                            </ol>
                        </nav>

                        <!-- Add User Button -->
                        <a href="{{ route('adduser') }}" class="btn btn-primary d-flex align-items-center btn-sm">
                            <i class="mdi mdi-plus me-1"></i> Add User
                        </a>
                    </div>

                    <h4 class="card-title mb-3">Users List</h4>

                    <!-- ✅ Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-dark-blue">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $s_no = 1; @endphp
                                @foreach ($user as $users)
                                    <tr>
                                        <td>{{ $s_no++ }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->role??'N/A' }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($users->created_at)->format('d M, Y') }}</td>
                                        <td class="text-center action-icons" style="white-space: nowrap;">
                                            <a href="{{ route('edit', $users->id) }}" title="Edit" class="text-primary me-2">
                                                <i class="mdi mdi-pencil fs-5"></i>
                                            </a>
                                            <a href="{{ route('view', $users->id) }}" title="View" class="text-success me-2">
                                                <i class="mdi mdi-eye fs-5"></i>
                                            </a>
                                            <a href="javascript:void(0);" 
                                            onclick="confirmDelete('{{ route('delete', $users->id) }}')" 
                                            title="Delete" 
                                            class="text-danger">
                                                <i class="mdi mdi-trash-can fs-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- ✅ Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $user->links('pagination::bootstrap-4') }}
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
        if (confirm("Are you sure you want to delete this user? This action cannot be undone!")) {
            window.location.href = deleteUrl;
        }
    }
</script>
@endpush
