@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/qrcode') }}">QRcode</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add QRcode</li>
        </ol>
    </nav>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add QRcode</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/qrcode/add') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Title <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                            <span style="color: red;">{{ $errors->first('title') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Price <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="price" class="form-control" placeholder="Enter Price" required>
                            <span style="color: red;">{{ $errors->first('price') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control editor" name="description" placeholder="Enter Description" ></textarea>
                            <span style="color: red;">{{ $errors->first('description') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/qrcode') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection