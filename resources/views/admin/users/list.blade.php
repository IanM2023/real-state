@extends('admin.admin_dashboard')


{{-- @section('style')
    <style type="text/css">    </style>
@endsection --}}
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="users">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
        
        <div class="d-flex align-items-center">
            <a href="javascript:void(0)" class="btn btn-info me-2">
                Admin {{ $totalAdmin }}
            </a>
            <a href="javascript:void(0)" class="btn btn-warning me-2">
                Agent {{ $totalAgent }}
            </a>
            <a href="javascript:void(0)" class="btn btn-secondary me-2">
                User {{ $totalUser }}
            </a>
            <a href="javascript:void(0)" class="btn btn-primary me-2">
                Active {{ $totalActive }}
            </a>
            <a href="javascript:void(0)" class="btn btn-danger me-2">
                In Active {{ $totalInactive }}
            </a>
            <a href="javascript:void(0)" class="btn btn-success">
                Total {{ $totalTotal }}
            </a>
        </div>
        
    </nav>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="card-title">User List table</h4>
                            <p class="text-muted">
                                <code>Users List</code>
                            </p>
                        </div>

                        <div class="d-flex align-items-center mb-4" style="gap: 10px;">
                            <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center mb-4" style="gap: 10px; flex-wrap: wrap;">
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <label class="form-label mb-0">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <label class="form-label mb-0">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            
                                <input type="text" name="search" class="form-control form-control-sm" style="width: 300px;" placeholder="Search users..." value="{{ request('search') }}">
                            
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                <a href="{{ url('admin/users') }}" class="btn btn-sm btn-secondary">Cancel</a>
                                <a href="{{ url('admin/users/add') }}" class="btn btn-sm btn-success">Add User</a>
                            </form>
                            
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Website</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Start date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            @if (!empty($user->photo))
                                                <a href="{{ asset('upload/' . $user->photo) }}" data-lightbox="example-set">
                                                    <img src="{{ $user->getFile() }}" alt="User Photo" class="wd-30 ht-30 rounded-circle">
                                                </a>
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->website ?? 'N/A' }}</td>
                                        <td>{{ $user->address ?? 'N/A' }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-info">Admin</span>
                                            @elseif ($user->role == 'agent')
                                                <span class="badge bg-primary">Agent</span>
                                            @elseif ($user->role == 'user')
                                                <span class="badge bg-success">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="badge bg-primary">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($user->created_at))
                                                {{ $user->created_at->format('F j, Y') }}
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- View Button --}}
                                            <a href="{{ url('admin/users/view/' . $user->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-eye icon-sm me-2">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <span>View</span>
                                            </a>
                                        
                                            {{-- Edit Button --}}
                                            <a href="{{ url('admin/users/edit/' . $user->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-edit-2 icon-sm me-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                        
                                            {{-- Delete Button (Styled Like the Others) --}}
                                            <a href="{{ url('admin/users/delete/' . $user->id) }}" onclick="return confirm('Are you sure you want to delete this user?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-trash icon-sm me-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center py-4">No Record Found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3 mb-2" style="float: right">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



