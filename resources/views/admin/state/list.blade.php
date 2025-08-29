@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='blog'>State</a></li>
            <li class="breadcrumb-item active" aria-current="page">State list</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">State List</h4>
                        <div class="d-flex align-items-center mb-4" style="gap: 10px;">
                            <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center mb-4" style="gap: 10px; flex-wrap: wrap;">
                                {{-- <input type="text" name="search" class="form-control form-control-sm" style="width: 300px;" placeholder="Search blog..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Search Blog</button>
                                <a href="{{ url('admin/blog') }}" class="btn btn-sm btn-danger">Reset</a> --}}
                                <a href="{{ url('admin/state/add') }}" class="btn btn-sm btn-success">Add New State</a>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th>Date Created</th>
                                    <th colspan="2" class="text-center" style="width: 150px;">Action</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                              
                                @forelse($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td> {{ $value->country->country_name }}</td>
                                    <td>{{ $value->state_name }}</td>
                                    <td> {{ $value->created_at->format('F j, Y') }}</td>
                                    <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/state/edit/' . $value->id) }}" class="dropdown-item align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit-2 icon-sm me-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                    </td>
                                    {{-- <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/state/view/' . $value->id) }}" class="dropdown-item align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-eye icon-sm me-2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <span>View</span>
                                        </a>
                                    </td> --}}
                                    <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/state/delete/' . $value->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this state?');"
                                            class="dropdown-item align-items-center">
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
                        <div style="padding: 20px; float: right;">
                            {{-- Pagination --}}
                            <div class="mt-3 mb-2" style="float: right">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
