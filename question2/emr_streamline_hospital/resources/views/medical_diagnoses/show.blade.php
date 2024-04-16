@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Medical Diagnosis Details') }}</div>

                <div class="card-body">
                    <div>
                        <p><strong>ID:</strong> {{ $medicalDiagnosis->id }}</p>
                        <p><strong>Name:</strong> {{ $medicalDiagnosis->name }}</p>
                        <p><strong>ICD-11 Code:</strong> {{ $medicalDiagnosis->icd_11_code }}</p>
                        <p><strong>Primary Diagnosis:</strong> {{ $medicalDiagnosis->is_primary_diagnosis ? 'Yes' : 'No' }}</p>
                    </div>
                    <a href="{{ route('medical_diagnoses.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
