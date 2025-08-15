@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='smtp'>SMTP Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
        </ol>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">SMTP Setting Update</h6>

                    <form class="forms-sample" method="post" action="{{ url('admin/smtp_update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">App Name <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="app_name" class="form-control" placeholder="Enter App Name" required value="{{ old('app_name', $getRecord->app_name) }}">
                                <span style="color: red;">{{ $errors->first('app_name') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Mailer <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_mailer" class="form-control" placeholder="Enter Mail Mailer" required value="{{ old('mail_mailer', $getRecord->mail_mailer) }}">
                                <span style="color: red;">{{ $errors->first('mail_mailer') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Host <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_host" class="form-control" placeholder="Enter Mail Host" required value="{{ old('mail_host', $getRecord->mail_host) }}">
                                <span style="color: red;">{{ $errors->first('mail_host') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Port <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_port" class="form-control" placeholder="Enter Mail Port" required value="{{ old('mail_port', $getRecord->mail_port) }}">
                                <span style="color: red;">{{ $errors->first('mail_port') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Username <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_username" class="form-control" placeholder="Enter Mail Username" required value="{{ old('mail_port', $getRecord->mail_port) }}">
                                <span style="color: red;">{{ $errors->first('mail_username') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Password <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_password" class="form-control" placeholder="Enter Mail Password" required value="{{ old('mail_password', $getRecord->mail_password) }}">
                                <span style="color: red;">{{ $errors->first('mail_password') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail Encryption <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_encryption" class="form-control" placeholder="Enter Mail Encryption" required value="{{ old('mail_encryption', $getRecord->mail_encryption) }}">
                                <span style="color: red;">{{ $errors->first('mail_encryption') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mail From Address <span style="color: red;"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="mail_from_address" class="form-control" placeholder="Enter Mail From Address" required value="{{ old('mail_from_address', $getRecord->mail_from_address) }}">
                                <span style="color: red;">{{ $errors->first('mail_from_address') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Update SMTP</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
@endsection
