@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Appointment Details') }}</div>

                <div class="card-body">
                    <p><strong>ID:</strong> {{ $appointment->id }}</p>
                    <p><strong>Patient:</strong> {{ optional($appointment->patient)->full_name }}</p>
                    <p><strong>Clinic:</strong> {{ $appointment->clinic->name }}</p>
                    <p><strong>Staff:</strong> {{ $appointment->user->name }}</p>
                    <p><strong>Clinical Notes:</strong> {{ $appointment->clinical_notes }}</p>
                    <p><strong>Date and Time:</strong> {{ $appointment->date_and_time }}</p>
                    <p><strong>Status:</strong> {{ $appointment->status }}</p>
                    <p><strong>Created At:</strong> {{ $appointment->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $appointment->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
