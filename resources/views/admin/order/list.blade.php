@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='order'>Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order list</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Order List</h4>
                        <div class="d-flex align-items-center mb-4" style="gap: 10px;">
                            <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center mb-4" style="gap: 10px; flex-wrap: wrap;">
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                    <label class="form-label mb-0">Start Date</label>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                    <label class="form-label mb-0">End Date</label>
                                </div>
                                <input type="text" name="search" class="form-control form-control-sm" style="width: 300px;" placeholder="Search users..." value="{{ request('search') }}">
                                
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                <a href="{{ url('admin/order') }}" class="btn btn-sm btn-secondary">Cancel</a>
                                <a href="{{ url('admin/order/add') }}" class="btn btn-sm btn-success">Add Order</a>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Color</th>
                                    <th>Date created</th>
                                    <th>Date updated</th>
                                    <th colspan="2" class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecordOrder as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->qty }}</td>
                                    <td>
                                        @foreach ($value->getColor as $value_color)
                                            {{ $value_color->color_name }}
                                        @endforeach
                                    </td>
                                    <td> {{ $value->created_at->format('F j, Y') }}</td>
                                    <td> {{ $value->created_at->format('F j, Y') }}</td>
                                    <td class="text-center" style="width: 50px;">
                                        <a href="{{ url('admin/order/edit/' . $value->id) }}" class="dropdown-item align-items-center">
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
                                        <a href="{{ url('admin/order/delete/' . $value->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this order?');"
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
