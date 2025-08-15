@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update User Info</li>
        </ol>
    </nav>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">User Info</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/users/edit/' . $getRecord->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $getRecord->name }}" required>
                            {{-- <span style="color: red;">{{ $errors->first('name') }}</span> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Username <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ !empty($getRecord->username) ? $getRecord->username : 'N/A' }}">
                            {{-- <span style="color: red;">{{ $errors->first('username') }}</span> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label  class="col-sm-3 col-form-label">Email <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Email" value="{{ $getRecord->email }}" readonly>
                            {{-- <span style="color: red;">{{ $errors->first('email') }}</span> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Phone # <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="number" name="phone" class="form-control" placeholder="Phone number"  value="{{ $getRecord->phone }}">
                            {{-- <span style="color: red;">{{ $errors->first('phone') }}</span> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Role <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin" {{ $getRecord->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="agent" {{ $getRecord->role == 'agent' ? 'selected' : '' }}>Agent</option>
                                <option value="user"  {{ $getRecord->role == 'user'  ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Status <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ $getRecord->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $getRecord->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection