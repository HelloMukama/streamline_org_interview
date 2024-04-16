@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Deleted Patients') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Restore all deleted patients button -->
                    <form action="{{ route('patients.restoreAll') }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-primary">Restore All</button>
                    </form>

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
                                <th scope="col">Next of Kin</th>
                                <th scope="col">Date Deleted</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trashedPatients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td scope="row">id:{{ $patient->id }}</td>
                                    <td>{{ $patient->file_number }}</td>
                                    <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->date_of_birth }}</td>
                                    <td>{{ $patient->phone_number }}</td>
                                    <td>{{ $patient->next_of_kin_relationship }} - {{ $patient->next_of_kin_phone_number }}</td>
                                    <td>{{ $patient->deleted_at }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('patients.restore', $patient->id) }}" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restore</button>
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
