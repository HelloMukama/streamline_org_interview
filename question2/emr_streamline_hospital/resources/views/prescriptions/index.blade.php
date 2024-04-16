@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ route('prescriptions.create') }}" class="btn btn-success">Add New Prescription</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Prescriptions') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Medical Record ID</th>
                                <th scope="col">Drug</th>
                                <th scope="col">Pharmacist</th>
                                <th scope="col">Instructions</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prescriptions as $prescription)
                                <tr>
                                    <th scope="row">{{ $prescription->id }}</th>
                                    <td>id:{{ $prescription->id }}</td>
                                    <td>{{ $prescription->medical_record_id }}</td>
                                    <td>{{ $prescription->drug ? $prescription->drug->name : 'N/A' }}</td>
                                    <td>{{ $prescription->pharmacist ? $prescription->pharmacist->name : 'N/A' }}</td>
                                    <td>{{ $prescription->instructions }}</td>
                                    <td>
                                        <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
