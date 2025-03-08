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
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="{{ route('adduser') }}" class="text-muted hover-cursor">Users&nbsp;/&nbsp;</p></a>
                            <p class="text-primary mb-0 hover-cursor">Add</p>
                        </div>
                        <h4 class="card-title">Users</h4>
                        <p class="card-description">
                        </p>
                        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-dark-blue sticky-top">
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sno = 1; @endphp
                                    @foreach ($user as $users )


                                        <tr>
                                            <td>{{ $sno++; }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->role }}</td>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->created_at }}</td>
                                            <td class="text-center" style="white-space: nowrap;">
                                                <a href="{{ route('edit',$users->id) }}" title="Edit" class="text-primary me-3">
                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                </a>
                                                <a href="{{ route('view',$users->id) }}" title="View" class="text-success me-3">
                                                    <i class="mdi mdi-eye fs-5"></i>
                                                </a>
                                                <a href="{{ route('delete',$users->id) }}" title="delete" class="text-success me-3">
                                                    <i class="mdi mdi-delete fs-5"></i>
                                                </a>

                                                                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-left mt-3">
                        {{ $user->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
