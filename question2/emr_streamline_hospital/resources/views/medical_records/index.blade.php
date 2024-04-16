@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ route('medical_records.create') }}" class="btn btn-success">Add New Medical Record</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Medical Records') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Symptoms</th>
                                <th>Diagnosis</th>
                                <th>Treatment</th>
                                <th>Outcome</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($medicalRecords as $medicalRecord)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>id:{{ $medicalRecord->id }}</td>
                                    <td>{{ $medicalRecord->symptoms }}</td>
                                    <td>{{ $medicalRecord->medicalDiagnosis->name }}</td>
                                    <td>{{ $medicalRecord->treatment }}</td>
                                    <td>{{ $medicalRecord->outcome }}</td>
                                    <td>
                                        <a href="{{ route('medical_records.show', $medicalRecord) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('medical_records.edit', $medicalRecord) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('medical_records.destroy', $medicalRecord) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No medical records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
