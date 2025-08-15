@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/week_time') }}">Week time</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Week Time</li>
        </ol>
    </nav>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Week Time</h6>
                <form class="forms-sample" method="POST" action="{{ url('admin/week_time/edit/'. $getRecord->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Time Format <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select id="timeFormat" name="timeFormat" class="form-control">
                                <option value="24" {{ $getRecord->time_format == '24' ? 'selected' : '' }}>24-hour</option>
                                <option value="12" {{ $getRecord->time_format == '12' ? 'selected' : '' }}>12-hour (AM/PM)</option>
                            </select>
                            
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Week Time <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select name="week_name_time" class="form-control" id="timeDropdown" required>
                                {{-- get the value of $getRecord->week_time --}}
                                <option value="">-- Select Time --</option>
                            </select>
                            <span style="color: red;">{{ $errors->first('week_name_time') }}</span>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('admin/week_time') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function populateTimeOptions(format, selectedTime = null) {
        const dropdown = document.getElementById('timeDropdown');
        dropdown.innerHTML = '<option value="">-- Select Time --</option>';

        for (let h = 0; h < 24; h++) {
            for (let m = 0; m < 60; m += 30) {
                let hour = h;
                let minute = m < 10 ? '0' + m : m;
                let label, value;

                if (format === '12') {
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    let h12 = hour % 12;
                    h12 = h12 === 0 ? 12 : h12;
                    label = `${h12}:${minute} ${ampm}`;
                    value = label;
                } else {
                    label = `${String(hour).padStart(2, '0')}:${minute}`;
                    value = label;
                }

                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;

                // Mark selected if matches current value
                if (selectedTime && value === selectedTime) {
                    option.selected = true;
                }

                dropdown.appendChild(option);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const timeFormat = document.getElementById('timeFormat');
        const selectedWeekTime = @json($getRecord->week_time); // Inject PHP value
        populateTimeOptions(timeFormat.value, selectedWeekTime);

        timeFormat.addEventListener('change', function () {
            populateTimeOptions(this.value);
        });
    });
</script>

@endpush
