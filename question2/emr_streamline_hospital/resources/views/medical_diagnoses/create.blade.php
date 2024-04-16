@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Medical Diagnosis') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medical_diagnoses.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icd_11_code" class="form-label">{{ __('ICD-11 Code') }}</label>
                            <input type="text" class="form-control @error('icd_11_code') is-invalid @enderror" id="icd_11_code" name="icd_11_code" required>
                            @error('icd_11_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_primary_diagnosis" name="is_primary_diagnosis" value="1">
                            <label class="form-check-label" for="is_primary_diagnosis">
                                {{ __('Primary Diagnosis') }}
                            </label>
                            @error('is_primary_diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Create Medical Diagnosis') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
