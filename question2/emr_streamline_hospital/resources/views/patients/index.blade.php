@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-between mb-4">
                <div class="col-md-6">
                    <a href="{{ route('patients.create') }}" class="btn btn-success">Add Patient</a>
                </div>
                <div class="col-md-6 text-right px-2">
                    <a href="{{ route('patients.trashed') }}" class="btn btn-secondary">View Deleted</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Patients') }}</div>

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
                                <th scope="col">File Number</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Next of Kin Relationship, <br>Phone Number</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>id:{{ $patient->id }}</td>
                                    <td>{{ $patient->file_number }}</td>
                                    <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->date_of_birth }}</td>
                                    <td>{{ $patient->phone_number }}</td>
                                    <td>{{ $patient->next_of_kin_relationship }}, <br>{{ $patient->next_of_kin_phone_number }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
