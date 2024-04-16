@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Medical Record') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medical_records.update', $medicalRecord->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="symptoms" class="form-label">{{ __('Symptoms') }}</label>
                            <textarea class="form-control" id="symptoms" name="symptoms" rows="3">{{ $medicalRecord->symptoms }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="medical_diagnosis_id" class="form-label">{{ __('Medical Diagnosis') }}</label>
                            <select class="form-select" id="medical_diagnosis_id" name="medical_diagnosis_id">
                                <option value="" selected disabled>Select Medical Diagnosis</option>
                                @foreach($medicalDiagnoses as $diagnosis)
                                    <option value="{{ $diagnosis->id }}" {{ $medicalRecord->medical_diagnosis_id == $diagnosis->id ? 'selected' : '' }}>{{ $diagnosis->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="treatment" class="form-label">{{ __('Treatment') }}</label>
                            <textarea class="form-control" id="treatment" name="treatment" rows="3">{{ $medicalRecord->treatment }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="outcome" class="form-label">{{ __('Outcome') }}</label>
                            <select class="form-select" id="outcome" name="outcome">
                                <option value="" selected disabled>Select Outcome</option>
                                <option value="admitted" {{ $medicalRecord->outcome == 'admitted' ? 'selected' : '' }}>Admitted</option>
                                <option value="died" {{ $medicalRecord->outcome == 'died' ? 'selected' : '' }}>Died</option>
                                <option value="referred" {{ $medicalRecord->outcome == 'referred' ? 'selected' : '' }}>Referred</option>
                                <option value="discharged" {{ $medicalRecord->outcome == 'discharged' ? 'selected' : '' }}>Discharged</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update Medical Record') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
