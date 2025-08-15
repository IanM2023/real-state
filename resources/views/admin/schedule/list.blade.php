@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='schedule'>Schedule</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-9 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">SCHEDULE LIST</h4>
                    </div>

                    <div class="table-responsive pt-3">
                        <form action="{{ url('admin/schedule') }}" method="post">
                            @csrf
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>WEEK DAYS</th>
                                        <th>OPEN / CLOSE</th>
                                        <th>START TIME</th>
                                        <th>END TIME</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($week as $day)
                                        @php
                                            $getuserweek = App\Models\Schedule::getDetail($day->id);
                                            $open_close  = !empty($getuserweek->status) ? $getuserweek->status : '';
                                            $start_time  = !empty($getuserweek->start_time) ? $getuserweek->start_time : '';
                                            $end_time    = !empty($getuserweek->end_time) ? $getuserweek->end_time : '';
                                        @endphp
                                        <tr>
                                            <td>
                                                <label class="form-control border-0 bg-transparent text-start">
                                                    {{ strtoupper($day->week_name) }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="switch form-control">
                                                    <input type="hidden" value="{{ $day->id }}" name="week[{{ $day->id }}][week_id]">
                                                    <input
                                                        type="checkbox"
                                                        name="week[{{ $day->id }}][status]"
                                                        id="statusCheckbox_{{ $day->id }}"
                                                        class="status-toggle"
                                                        data-id="{{ $day->id }}"
                                                        {{ $open_close == 1 ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                            <td>
                                                <select
                                                    name="week[{{ $day->id  }}][start_time]"
                                                    class="form-control time-start"
                                                    id="start_time_{{ $day->id }}"
                                                    {{ $open_close == 1 ? '' : 'disabled' }}>
                                                    <option value="" class="text-center">--- Select Start Time ---</option>
                                                    @foreach ($week_time as $time_start)
                                                        <option value="{{ $time_start->week_time }}" {{ $start_time == $time_start->week_time ? 'selected' : '' }} class="text-center">
                                                            {{ $time_start->week_time }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select
                                                    name="week[{{ $day->id  }}][end_time]"
                                                    class="form-control time-end"
                                                    id="end_time_{{ $day->id }}"
                                                    {{ $open_close == 1 ? '' : 'disabled' }}>
                                                    <option value="" class="text-center">--- Select End Time ---</option>
                                                    @foreach ($week_time as $time_end)
                                                        <option value="{{ $time_end->week_time }}" {{ $end_time == $time_end->week_time ? 'selected' : '' }} class="text-center">
                                                            {{ $time_end->week_time }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center py-4">No Record Found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            {{-- <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.status-toggle');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const startSelect = document.getElementById('start_time_' + id);
                const endSelect = document.getElementById('end_time_' + id);

                if (this.checked) {
                    startSelect.removeAttribute('disabled');
                    endSelect.removeAttribute('disabled');
                } else {
                    startSelect.value = "";
                    endSelect.value = "";
                    startSelect.setAttribute('disabled', true);
                    endSelect.setAttribute('disabled', true);
                }
            });
        });

        //Add form validation before submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            let hasError = false;
            let message = '';

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    const id = checkbox.getAttribute('data-id');
                    const startSelect = document.getElementById('start_time_' + id);
                    const endSelect = document.getElementById('end_time_' + id);

                    if (!startSelect.value || !endSelect.value) {
                        hasError = true;
                        message += `Start and End time are required for week ID ${id}.\n`;
                    }
                }
            });

            if (hasError) {
                e.preventDefault();
                alert(message || 'Please complete all required fields.');
            }
        });
    });
</script>

@endpush