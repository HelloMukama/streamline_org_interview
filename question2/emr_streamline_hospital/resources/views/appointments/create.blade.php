@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Appointment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">{{ __('Patient') }}</label>
                            <select class="form-select" id="patient_id" name="patient_id" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="clinic_id" class="form-label">{{ __('Clinic') }}</label>
                            <select class="form-select" id="clinic_id" name="clinic_id" required>
                                @foreach($clinics as $clinic)
                                    <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="staff_id" class="form-label">{{ __('Staff') }}</label>
                            <select class="form-select" id="staff_id" name="staff_id" required>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="clinical_notes" class="form-label">{{ __('Clinical Notes') }}</label>
                            <textarea class="form-control" id="clinical_notes" name="clinical_notes" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="date_and_time" class="form-label">{{ __('Date and Time') }}</label>
                            <input id="date_and_time" type="datetime-local" class="form-control" name="date_and_time" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="postponed">Postponed</option>
                                <option value="brought_forward">Brought Forward</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="started">Started</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save New Appointment') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
