@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Patient Details</div>

                    <div class="card-body">
                        <p><strong>File Number:</strong> {{ $patient->file_number }}</p>
                        <p><strong>First Name:</strong> {{ $patient->first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $patient->last_name }}</p>
                        <p><strong>Gender:</strong> {{ $patient->gender }}</p>
                        <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth }}</p>
                        <p><strong>Phone Number:</strong> {{ $patient->phone_number }}</p>
                        <p><strong>Next of Kin Relationship:</strong> {{ $patient->next_of_kin_relationship }}</p>
                        <p><strong>Next of Kin Phone Number:</strong> {{ $patient->next_of_kin_phone_number }}</p>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
