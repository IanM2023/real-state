@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='notification'>Notification</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Push Notification</h6>

                    <form class="forms-sample" method="post" action="{{ url('admin/notification_send') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Username <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <select name="user_id" class="form-control">
                                    <option value="">Select Username</option>
                                    @foreach ($getRecord as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }} {{ $value->username }} ({{ $value->role }})</option>
                                    @endforeach
                                </select>
                                <span style="color: red;">{{ $errors->first('username') }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Title <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="Title" required value="{{ old('title') }}">
                                <span style="color: red;">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-3 col-form-label">Message <span style="color: red;"> *</span></label>
                            <textarea class="form-control" name="message" rows="5"></textarea>
                            <span style="color: red;">{{ $errors->first('name') }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Send Notification</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
@endsection
