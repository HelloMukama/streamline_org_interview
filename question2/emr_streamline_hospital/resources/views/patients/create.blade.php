@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Patient') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('patients.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="file_number" class="form-label">File Number:</label>
                        <input type="text" name="file_number" id="file_number" class="form-control" value="{{ old('file_number') }}">
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth:</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number:</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                    </div>

                    <div class="mb-3">
                        <label for="next_of_kin_relationship" class="form-label">Next of Kin Relationship:</label>
                        <select name="next_of_kin_relationship" id="next_of_kin_relationship" class="form-select">
                            <option value="parent" {{ old('next_of_kin_relationship') == 'parent' ? 'selected' : '' }}>Parent</option>
                            <option value="spouse" {{ old('next_of_kin_relationship') == 'spouse' ? 'selected' : '' }}>Spouse</option>
                            <option value="sibling" {{ old('next_of_kin_relationship') == 'sibling' ? 'selected' : '' }}>Sibling</option>
                            <option value="child" {{ old('next_of_kin_relationship') == 'child' ? 'selected' : '' }}>Child</option>
                            <option value="friend" {{ old('next_of_kin_relationship') == 'friend' ? 'selected' : '' }}>Friend</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="next_of_kin_phone_number" class="form-label">Next of Kin Phone Number:</label>
                        <input type="text" name="next_of_kin_phone_number" id="next_of_kin_phone_number" class="form-control" value="{{ old('next_of_kin_phone_number') }}">
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Patient') }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
