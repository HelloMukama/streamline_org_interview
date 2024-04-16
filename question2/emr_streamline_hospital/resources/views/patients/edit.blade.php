@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Patient</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patients.update', ['patient' => $patient->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="file_number" class="form-label">File Number:</label>
                                <input type="text" name="file_number" id="file_number" class="form-control" value="{{ $patient->file_number }}">
                            </div>

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $patient->first_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $patient->last_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $patient->date_of_birth }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $patient->phone_number }}">
                            </div>

                            <div class="mb-3">
                                <label for="next_of_kin_relationship" class="form-label">Next of Kin Relationship:</label>
                                <select name="next_of_kin_relationship" id="next_of_kin_relationship" class="form-select">
                                    <option value="parent" {{ $patient->next_of_kin_relationship == 'parent' ? 'selected' : '' }}>Parent</option>
                                    <option value="spouse" {{ $patient->next_of_kin_relationship == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                    <option value="sibling" {{ $patient->next_of_kin_relationship == 'sibling' ? 'selected' : '' }}>Sibling</option>
                                    <option value="child" {{ $patient->next_of_kin_relationship == 'child' ? 'selected' : '' }}>Child</option>
                                    <option value="friend" {{ $patient->next_of_kin_relationship == 'friend' ? 'selected' : '' }}>Friend</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="next_of_kin_phone_number" class="form-label">Next of Kin Phone Number:</label>
                                <input type="text" name="next_of_kin_phone_number" id="next_of_kin_phone_number" class="form-control" value="{{ $patient->next_of_kin_phone_number }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
