@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/profile') }}">Change Pass</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Password</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Change Password</h6>
                    <form method="POST" action="{{ url('admin/profile/change-pass/'. Auth::user()->id) }}" class="forms-sample">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control" autocomplete="off" placeholder="Current Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" autocomplete="off" placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection