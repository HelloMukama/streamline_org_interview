@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ route('medical_diagnoses.create') }}" class="btn btn-success">Create New Medical Diagnosis</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Medical Diagnoses') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>ICD-11 Code</th>
                                <th>Primary Diagnosis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalDiagnoses as $medicalDiagnosis)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>id:{{ $medicalDiagnosis->id }}</td>
                                <td>{{ $medicalDiagnosis->name }}</td>
                                <td>{{ $medicalDiagnosis->icd_11_code }}</td>
                                <td>{{ $medicalDiagnosis->is_primary_diagnosis ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('medical_diagnoses.edit', $medicalDiagnosis->id) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <a href="{{ route('medical_diagnoses.show', $medicalDiagnosis->id) }}" class="btn btn-sm btn-info">{{ __('View') }}</a>
                                    <form action="{{ route('medical_diagnoses.destroy', $medicalDiagnosis->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this medical diagnosis?')">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
