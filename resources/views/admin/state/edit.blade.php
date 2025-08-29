@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/state') }}">State</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit State</li>
        </ol>
    </nav>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit State</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/state/edit/' . $getState->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Country Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="countries_id">
                                <option value="">Select Country</option>
                          
                                @foreach ($getRecord as $country)
                                <option 
                                    value="{{ $country->id }}"
                                    {{ $getState->countries_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">State Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="state_name" class="form-control" placeholder="Enter State Name" value="{{ old('state_name', $getState->state_name) }}" required>
                            <span style="color: red;">{{ $errors->first('state_name') }}</span>
                        </div>
                    </div>
        

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/state') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection