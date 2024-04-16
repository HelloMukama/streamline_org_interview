@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Medical Record') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medical_records.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">{{ __('Patient') }}</label>
                            <select class="form-select" id="patient_id" name="patient_id" required>
                                <option value="" selected disabled>Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="symptoms" class="form-label">{{ __('Symptoms') }}</label>
                            <textarea class="form-control" id="symptoms" name="symptoms" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="medical_diagnosis_id" class="form-label">{{ __('Medical Diagnosis') }}</label>
                            <select class="form-select" id="medical_diagnosis_id" name="medical_diagnosis_id">
                                <option value="" selected disabled>Select Medical Diagnosis</option>
                                @foreach($medicalDiagnoses as $diagnosis)
                                    <option value="{{ $diagnosis->id }}">{{ $diagnosis->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="treatment" class="form-label">{{ __('Treatment') }}</label>
                            <textarea class="form-control" id="treatment" name="treatment" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="outcome" class="form-label">{{ __('Outcome') }}</label>
                            <select class="form-select" id="outcome" name="outcome" required>
                                <option value="" selected disabled>Select Outcome</option>
                                <option value="admitted">Admitted</option>
                                <option value="died">Died</option>
                                <option value="referred">Referred</option>
                                <option value="discharged">Discharged</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Create Medical Record') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
