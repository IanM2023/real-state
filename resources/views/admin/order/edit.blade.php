@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/order') }}">Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
        </ol>
    </nav>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Order</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/order/edit/' . $getRecord->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Product Name <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="product_id">
                                <option value="">Select Product</option>
                                @foreach ($getProduct as  $va_pro)
                                    <option {{ ($getRecord->product_id == $va_pro->id) ? 'selected' : '' }} value="{{ $va_pro->id }}">
                                        {{ $va_pro->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Available Color <span style="color: red;"> *</span></label>
                        <div class="col-sm-9">
                            <div class="row">
                                @forelse ($getColor as $value)
                                    @php
                                        $selected = '';
                                    @endphp
                                    @foreach ($getOrderDetail as $option)
                                        @if ($option->color_id == $value->id)
                                            @php
                                                $selected = 'checked';
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="col-3"> {{-- 12 / 3 = 4 columns per row --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="color_id[]" value="{{ $value->id }}" {{ $selected }} id="color{{ $value->id }}">
                                            <label class="form-check-label" for="color{{ $value->id }}">
                                                {{ $value->color_name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted fst-italic">No colors available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Quantity <span style="color: red;"> *</span></label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" name="qty" value="{{ old('qty', $getRecord->qty) }}" min="0">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/order') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection