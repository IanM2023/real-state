@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    @include('_message')
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-5 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">About</h6>
                    </div>
                    <p>{{ $getRecord->about }}</p>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name</label>
                        <p class="text-muted">{{ $getRecord->name }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">UserName</label>
                        <p class="text-muted">{{ $getRecord->username }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Contact #</label>
                        <p class="text-muted">{{ !empty($getRecord->phone) ?  $getRecord->phone : 'N/A'}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined</label>
                        <p class="text-muted">{{ $getRecord->updated_at->format('F j, Y') }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives</label>
                        <p class="text-muted">{{ $getRecord->address }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email</label>
                        <p class="text-muted">{{ $getRecord->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Website</label>
                        <p class="text-muted">{{ $getRecord->website }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-7 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
            
                            <h6 class="card-title">Profile Update</h6>

                            <form class="forms-sample" action="{{ url('admin_profile/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- {{ csrf_field() }} --}}
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $getRecord->name }}" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ $getRecord->username }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $getRecord->email }}">
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone #</label>
                                    <input type="number" class="form-control" placeholder="Phone Number" name="phone" value="{{ $getRecord->phone }}">
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    (Leave blank if you are not changing the password)
                                </div> --}}
                                <div class="mb-3">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" class="form-control"  name="photo">
                                    @if (!empty($getRecord->photo))
                                        <img src="{{ asset('upload/' . $getRecord->photo) }}" alt="" style="width: 10%; height: 10%; padding-top: 15px;">
                                    @endif
                                   
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $getRecord->address }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">About</label>
                                    <textarea type="text" class="form-control" placeholder="About" name="about">{{ $getRecord->about }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" placeholder="Website" name="website" value="{{ $getRecord->website }}">
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url('admin/profile') }}'">Cancel</button>

                            </form>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

