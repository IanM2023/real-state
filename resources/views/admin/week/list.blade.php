@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/week') }}">Week</a></li>
            <li class="breadcrumb-item active" aria-current="page">Week List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Week List</h4>
                        <div class="d-flex align-items-center">
                            <a href="{{ url('admin/week/add') }}" class="btn btn-sm btn-success">Add Week</a>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Week Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th colspan="2" class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ strtoupper($value->week_name) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                                    <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/week/edit/' . $value->id) }}" class="dropdown-item align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit-2 icon-sm me-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                    </td>
                                    <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/week/delete/' . $value->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this week?');"
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
          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection