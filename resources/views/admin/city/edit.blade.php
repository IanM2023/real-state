@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/city') }}">City</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit City</li>
        </ol>
    </nav>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit City</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/city/edit/' .$getCity->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Country Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="countries_id" id="country" required>
                                <option value="">Select Country</option>
                                @foreach ($getCountries as $country)
                                    <option 
                                        value="{{ $country->id }}"
                                        {{ $getCity->state->countries_id == $country->id ? 'selected' : '' }}>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">State Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="state_id" id="state" required>
                                <option value="">Select State</option>
                                @foreach ($getStates as $state)
                                    <option 
                                        value="{{ $state->id }}"
                                        {{ $getCity->state_id == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">City Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="city_name" class="form-control" 
                                   value="{{ $getCity->city_name }}" 
                                   placeholder="Enter City Name" required>
                            <span style="color: red;">{{ $errors->first('city_name') }}</span>
                        </div>
                    </div>
                    
        

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/city') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection