@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Prescription') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prescriptions.update', $prescription->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="medical_record_id" class="form-label">{{ __('Medical Record') }}</label>
                                <select class="form-select" id="medical_record_id" name="medical_record_id" required>
                                    @foreach($medicalRecords as $record)
                                        <option value="{{ $record->id }}" {{ $prescription->medical_record_id == $record->id ? 'selected' : '' }}>{{ $record->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="drug_id" class="form-label">{{ __('Drug') }}</label>
                                <select class="form-select" id="drug_id" name="drug_id" required>
                                    @foreach($drugs as $drug)
                                        <option value="{{ $drug->id }}" {{ $prescription->drug_id == $drug->id ? 'selected' : '' }}>{{ $drug->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pharmacist_id" class="form-label">{{ __('Pharmacist') }}</label>
                                <select class="form-select" id="pharmacist_id" name="pharmacist_id" required>
                                    @foreach($pharmacists as $pharmacist)
                                        @if ($pharmacist->hasRole('pharmacist'))
                                            <option value="{{ $pharmacist->id }}" {{ $prescription->pharmacist_id == $pharmacist->id ? 'selected' : '' }}>{{ $pharmacist->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="instructions" class="form-label">{{ __('Instructions') }}</label>
                                <textarea class="form-control" id="instructions" name="instructions" rows="3" required>{{ $prescription->instructions }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Update Prescription') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
