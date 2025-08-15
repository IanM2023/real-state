@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/week') }}">Week</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Week</li>
        </ol>
    </nav>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Week</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/week/add') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Week Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="week_name" class="form-control" placeholder="Week name" required>
                            <span style="color: red;">{{ $errors->first('week_name') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/week') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection