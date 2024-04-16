@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Medical Record Details') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="patient">Patient:</label>
                        <p>{{ optional($medicalRecord->patient)->first_name }} {{ optional($medicalRecord->patient)->last_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="symptoms">Symptoms:</label>
                        <p>{{ $medicalRecord->symptoms }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosis">Medical Diagnosis:</label>
                        <p>{{ $medicalRecord->medicalDiagnosis->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="treatment">Treatment:</label>
                        <p>{{ $medicalRecord->treatment }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="outcome">Outcome:</label>
                        <p>{{ $medicalRecord->outcome }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="created_at">Created At:</label>
                        <p>{{ $medicalRecord->created_at }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="updated_at">Updated At:</label>
                        <p>{{ $medicalRecord->updated_at }}</p>
                    </div>
                    
                    <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">Back to Medical Records</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
