@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ route('appointments.create') }}" class="btn btn-success">Record New Appointment</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Appointments') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Clinic</th>
                                <th scope="col">Staff</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($appointments as $appointment)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td scope="row">id:{{ $appointment->id }}</td>
                                <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                                <td>{{ $appointment->clinic->name }}</td>
                                <td>{{ $appointment->user->name }}</td>
                                <td>{{ $appointment->date_and_time }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</button>
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
