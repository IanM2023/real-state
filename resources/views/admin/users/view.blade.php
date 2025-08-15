@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
{{-- ROW that holds two separate cards --}}
<div class="row">

    <div class="col-12 col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title text-start">User Profile</h6>
                
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('upload/' . ($getRecord->photo ?? 'default_image.jpg')) }}"
                         alt="User photo"
                         class="rounded-circle img-fluid"
                         style="width: 100%; max-width: 350px; aspect-ratio: 1/1; object-fit: cover;">
                </div>
    
                {{-- Centered Username under the photo --}}
                <div class="mt-5">
                    <div class="fw-bold">User Name</div>
                    <div>
                        @if (!empty($getRecord->username))
                            {{ $getRecord->username }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    

    {{-- RIGHT: details / form card ----------------------------- --}}
    <div class="col-12 col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">{{ $getRecord->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">{{ $getRecord->email }}</div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">{{ $getRecord->phone }}</div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">{{ $getRecord->address }}</div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            @if ($getRecord->role == 'admin')
                                <span class="badge bg-info">Admin</span>
                            @elseif ($getRecord->role == 'agent')
                                <span class="badge bg-primary">Agent</span>
                            @elseif ($getRecord->role == 'user')
                                <span class="badge bg-success">User</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            @if ($getRecord->status == 'active')
                                <span class="badge bg-primary">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">About</label>
                        <div class="col-sm-9 text-break">
                            {{ $getRecord->about }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Website</label>
                        <div class="col-sm-9 text-break">
                            <a href="{{ $getRecord->website }}" target="_blank">{{ $getRecord->website }}</a>
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Created On</label>
                        <div class="col-sm-9">{{ $getRecord->created_at->format('F d, Y - h:i A') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Last Updated</label>
                        <div class="col-sm-9">{{ $getRecord->updated_at->format('F d, Y - h:i A') }}</div>
                    </div>
                    

                    <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>

                </form>

            </div>
        </div>
    </div>

</div>

    
</div>

@endsection